<?php

namespace App\Http\Controllers\Customer\PersonalProfile;

use App\Http\Controllers\Controller;
use App\Actions\Customer\Personal\CreatePersonalCustomerProfileAction;
use App\Exceptions\Customer\Personal\PersonalCustomerProfileAlreadyExistsException;
use App\Exceptions\Customer\Personal\PersonalProfileCreationException;
use App\Http\Requests\Customer\Personal\CreatePersonalCustomerProfileRequest;

class CustomerPersonalProfileController extends Controller
{
    public function create_personal_profile()
    {
        return view('customer.personal.profile.create-personal-profile');
    }

    public function store_personal_profile(CreatePersonalCustomerProfileRequest $request, CreatePersonalCustomerProfileAction $action)
    {
        try {

            $action->execute($request->dto($this->user()));

            return redirect()->route('customer.index');
            
        } catch (PersonalCustomerProfileAlreadyExistsException $e) {

            return back()->with('error', 'Hai già un profilo personale.');
        
        } catch (PersonalProfileCreationException $e) {

            logger()->error(
                'Personal profile creation failed',
                [
                    'user_id' => $this->user()->id,
                    'exception' => $e,
                ]
            );

            return back()->withInput()->with('error', 'Non è stato possibile creare il profilo personale.');
        }
    }
}
