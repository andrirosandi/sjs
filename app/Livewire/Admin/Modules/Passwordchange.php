<?php

namespace App\Livewire\Admin\Modules;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class Passwordchange extends Component
{

    public $data = [
        'title' => 'Change Password'
    ];
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public $message;
    public $errors, $errorsInput;

    protected function validateInputs()
    {
        $this->errors = null;
        $this->errorsInput = null;
        $input = [
            'current_password' => $this->current_password,
            'new_password' => $this->new_password,
            'new_password_confirmation' => $this->new_password_confirmation,
        ];

        $rules = [
            'current_password' => 'required',
            'new_password' => ['required','different:current_password', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'new_password_confirmation' => 'required|same:new_password',
        ];

        try {
            $val = Validator::make($input, $rules);
            return $val->validate();
        } catch (ValidationException $e) {
            $this->message = "Update Failed";
            $this->errors = $e->validator->errors()->all();
            $this->errorsInput = $e->validator->errors()->messages();
            return false;
        }
    }

    public function updatePassword()
    {
        if (!$this->validateInputs()) {
            return;
        }

        $user = session('user');

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The provided password does not match your current password.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->message = "Password updated successfully.";
    }
    function mount() {
        
        $this->dispatch('GlobalData',$this->data);

       
        // dump($object->get());
    }
    public function render()
    {
        return view('livewire.admin.modules.passwordchange');
    }
}
