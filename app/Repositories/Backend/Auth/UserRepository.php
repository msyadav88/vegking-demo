<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Events\Backend\Auth\User\UserRestored;
use App\Events\Backend\Auth\User\UserConfirmed;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Events\Backend\Auth\User\UserUnconfirmed;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Notifications\Backend\Auth\UserAccountActive;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use DateTime;
use App\Buyer;
use App\Seller;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return mixed
     */
    public function getUnconfirmedCount() : int
    {
        return $this->model
            ->where('confirmed', false)
            ->count();
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function create(array $data) : User
    {
        return DB::transaction(function () use ($data) {
            $user = parent::create([
                'first_name' => extract_name($data['name'])['first_name'],
                'last_name' => extract_name($data['name'])['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company_name' => $data['company_name'],
                'password' => $data['password'],
                'active' => isset($data['active']) && $data['active'] === '1',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => isset($data['confirmed']) && $data['confirmed'] === '1',
            ]);

            // See if adding any additional permissions
            if (! isset($data['permissions']) || ! count($data['permissions'])) {
                $data['permissions'] = [];
            }


            if ($user) {
                // User must have at least one role
                if (! count($data['roles'])) {
                    throw new GeneralException(__('exceptions.backend.access.users.role_needed_create'));
                }

                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);

                //Send confirmation email if requested and account approval is off
                if ($user->confirmed === false && isset($data['confirmation_email']) && ! config('access.users.requires_approval')) {
                    $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                }
				$dt = new DateTime();
				$users = DB::table('users')->select('id','first_name','last_name','email','phone')->where('users.id',$user->id)->get();

				$username = $user->first_name. ' ' . $user->last_name;

				$buyer_seller_array = array('username'=>$username,'name'=>$username,'email'=>$user->email,'phone'=>$user->phone,'user_id'=>$user->id,'created_at' => $dt->format('Y-m-d H:i:s'),'updated_at'=> $dt->format('Y-m-d H:i:s'));

				if(in_array('seller', $data['roles'])) {
					DB::table('sellers')->insert($buyer_seller_array);
                }
                if(in_array('buyer', $data['roles'])) {
					DB::table('buyers')->insert($buyer_seller_array);
				}

				DB::table('users')->where('id',$user->id)->update(['user_code'=>$user->first_name]);

				$users = DB::table('affiliate_data')->select('id','u_id','aff_code','user_code')->where('affiliate_data.user_code',$user->first_name)->get();

				if($users->count() == 0) {
					$data = array('u_id'=>$user->id,'aff_code'=>'ac',"user_code"=>$user->first_name,'created_at' => $dt->format('Y-m-d H:i:s'),'updated_at'=> $dt->format('Y-m-d H:i:s'));
					DB::table('affiliate_data')->insert($data);
				}

				event(new UserCreated($user));
				return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function update(User $user, array $data) : User
    {
        $buyer_seller_array['user_id'] = $user->id;
        $buyer_seller_array['username'] =$user->name;
        $buyer_seller_array['name'] =$user->name;
        $buyer_seller_array['phone'] = $user->phone;
        $buyer_seller_array['email'] = $user->email;

        if(in_array("buyer",$data['roles'])){
                $buyer_count = Buyer::where('user_id',$user->id )->count();
                if($buyer_count == 0) {
                    Buyer::create($buyer_seller_array);
                }
        }
        if(in_array("seller",$data['roles'])){
            $seller_count = Seller::where('user_id',$user->id )->count();
            if($seller_count == 0) {
                 Seller::create($buyer_seller_array);
            }
        }

        $this->checkUserByEmail($user, $data['email']);

        // See if adding any additional permissions
        if (! isset($data['permissions']) || ! count($data['permissions'])) {
            $data['permissions'] = [];
        }

        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'first_name' => extract_name($data['name'])['first_name'],
                'last_name' => extract_name($data['name'])['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ])) {
                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);

                event(new UserUpdated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * @param User $user
     * @param      $input
     *
     * @throws GeneralException
     * @return User
     */
    public function updatePassword(User $user, $input) : User
    {
        if ($user->update(['password' => $input['password']])) {
            event(new UserPasswordChanged($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param User $user
     * @param      $status
     *
     * @throws GeneralException
     * @return User
     */
    public function mark(User $user, $status) : User
    {
        if ($status === 0 && auth()->id() === $user->id) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->active = $status;

        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
            break;
            case 1:
                event(new UserReactivated($user));
            break;
        }

        if ($user->save()) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function confirm(User $user) : User
    {
        if ($user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->confirmed = true;
        $confirmed = $user->save();

        if ($confirmed) {
            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('access.users.requires_approval')) {
                $user->notify(new UserAccountActive);
            }

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_confirm'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function unconfirm(User $user) : User
    {
        if (! $user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.not_confirmed'));
        }

        if ($user->id === 1) {
            // Cant un-confirm admin
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_admin'));
        }

        if ($user->id === auth()->id()) {
            // Cant un-confirm self
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_self'));
        }

        $user->confirmed = false;
        $unconfirmed = $user->save();

        if ($unconfirmed) {
            event(new UserUnconfirmed($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function forceDelete(User $user) : User
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($user) {
            // Delete associated relationships
            $user->passwordHistories()->delete();
            $user->providers()->delete();

            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function restore(User $user) : User
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param User $user
     * @param      $email
     *
     * @throws GeneralException
     */
    protected function checkUserByEmail(User $user, $email)
    {
        // Figure out if email is not the same and check to see if email exists
        if ($user->email !== $email && $this->model->where('email', '=', $email)->first()) {
            throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
        }
    }
}
