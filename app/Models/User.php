<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $primaryKey = 'AdminID';

    protected $fillable = [
        'AdminName',
        'AdminEmail',
        'AdminPassword',
    ];
}

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'CategoryID';

    protected $fillable = [
        'CategoryName',
        'CategoryDescription',
    ];
}

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $primaryKey = 'CustomerID';

    protected $fillable = [
        'CustomerName',
        'CustomerEmail',
        'CustomerPhoneNum',
        'CustomerAddress',
        'CustomerMembership',
        'AdminID',
    ];
}

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'OrderID';

    protected $fillable = [
        'OrderName',
        'OrderDate',
        'OrderAmount',
        'CustomerID',
    ];
}

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $primaryKey = 'OrderItemID';

    protected $fillable = [
        'OrderID',
        'ToyID',
        'OrderItemQuantity',
    ];
}

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $primaryKey = 'PromotionID';

    protected $fillable = [
        'PromotionName',
        'PromotionDiscountPercent',
        'StartDate',
        'EndDate',
        'ToyID',
    ];
}

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';

    protected $primaryKey = 'SellerID';

    protected $fillable = [
        'SellerName',
        'SellerEmail',
        'SellerPhoneNum',
        'SellerPassword',
        'AdminID',
    ];
}

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $primaryKey = 'StoreID';

    protected $fillable = [
        'StoreName',
        'StoreLocation',
        'StoreContactInfo',
        'SellerID',
    ];
}

class Toy extends Model
{
    use HasFactory;

    protected $table = 'toys';

    protected $primaryKey = 'ToyID';

    protected $fillable = [
        'ToyName',
        'ToyPrice',
        'ToyQuantity',
        'CategoryID',
    ];
}
