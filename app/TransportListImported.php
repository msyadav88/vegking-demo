<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class TransportListImported extends Model{
    protected $fillable = [
    	'reference',
        'loading_date',
        'unloading_date',
        'consignorloadercustomer',
        'loading_point',
        'unloading_point',
        'customer',
        'gross_weight',
        'nett_weight',
        'unloaded_weight',
        'payweight',
        'diff',
        'no_pack',
        'temp',
        'kind_of_trailer',
        'truck_plates',
        'container_no',
        'load_eta',
        'del_eta',
        'driver_phone_number',
        'carrier',
        'variety',
        'kind_of_cargo',
        'kind_of_payment_for_transport',
        'transport_cost',
        'pln_transport',
        'notices',
        'cmr',
        'transport_invoice',
        'transport_invoice_uk',
        'sales_invoice',
        'sales_price',
        'payment_period',
        'purchase_invoice',
        'paid',
        'purchase_rate',
        'date_od_purchase_invoice',
        'transport_payment_term',
        'carrier_documents',
        'order',
        'status',
    ];

    protected $table = 'transport_list_imported';
}
