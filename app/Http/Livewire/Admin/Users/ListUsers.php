<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class ListUsers extends Component
{
    public $data = [];

    public $user;

    public $editingUser = false;

    public $userIdRemoval;

    public function create()
    {
        $this->data = [];
        $this->editingUser = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {
        $validatedData = Validator::make($this->data, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ])->validate();

        User::create($validatedData);

        // session()->flash('message', 'New user is successfully created.');

        $this->dispatchBrowserEvent('hide-form', ['message' => 'New user is successfully created.']);
    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->editingUser = true;
        $this->data = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validatedData = Validator::make($this->data, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if (empty($validatedData['password'])) {
            $validatedData['password'] = $this->user->password;
        }

        $this->user->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'This user is successfully updated.']);
    }

    public function deleteConfirmation($userId)
    {
        $this->userIdRemoval = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete()
    {
        $user = User::findOrFail($this->userIdRemoval);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'That user is successfully deleted.']);
    }

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', compact('users'));
    }
}
