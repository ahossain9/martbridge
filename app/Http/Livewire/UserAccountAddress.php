<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserAccountAddress extends Component
{
    //fields
    public $name;

    public $first_name;

    public $last_name;

    public $phone;

    public $email;

    public $address;

    public $address2;

    public $city;

    public $state;

    public $zip_code;

    public $country = 'BD';

    public $status = 'active';

    public $is_default;

    //rules
    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'zip_code' => 'required|string',
        'country' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.user-account-address');
    }

    public function submit()
    {
        $this->validate();

        $customer = auth()->user();
        //first or create
        $address = $customer->addresses()->where('email', auth()->user()->email)->first();
        $data = [
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
        ];

        if ($address) {
            $address->update($data);
        } else {
            $customer->addresses()->create($data);
        }

        //        notify()->success('Address added successfully', 'Success');

    }
}
