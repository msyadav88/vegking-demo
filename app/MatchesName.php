<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class MatchesName extends Model{
    protected $table = 'matches_name';
    protected $fillable = ['short_names', 'status'];
}
