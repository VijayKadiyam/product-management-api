<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
    'name', 'email', 'address', 'contact1', 'contact2', 'state_code', 'pan_no', 'gstn_no', 'acc_name', 'acc_no', 'ifsc_code', 'branch'
  ];

  /*
   * A customer belongs to a company
   *
   *@
   */
  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  /*
   * To store a new customer
   *
   *@
   */
  public function store()
  {
    if(request()->header('company-id')) {
      $company = Company::find(request()->header('company-id'));
      if($company)
        $company ? $company->customers()->save($this) : '';
    } 

    return $this;
  }

  /*
   * A customer has many billings
   *
   *@
   */
  public function billings()
  {
    return $this->hasMany(Billing::class)
      ->with('billing_details', 'billing_taxes', 'billing_discounts', 'customer', 'company')
      ->latest(); 
  }
}
