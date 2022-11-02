<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">

                    <div class="d-flex justify-content-end mb-2">
                        <button wire:click.prevent="create" type="button" class="btn btn-primary"><i
                                class="fas fa-plus-circle mr-1"></i> Add New
                            User</button>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Options</td>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="#" class="mr-3" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"
                                                    wire:click.prevent="edit({{ $user }})"><i
                                                        class="fas fa-edit text-primary"></i></a>
                                                <a href="" class="" data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    wire:click.prevent="deleteConfirmation({{ $user->id }})"><i
                                                        class="fas fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <div class="my-1">There is no data to show.</div>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Form Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <form wire:submit.prevent="{{ $editingUser ? 'update' : 'store' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($editingUser)
                                <span>Edit User</span>
                            @else
                                <span>Add New User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" aria-describedby="nameHelp" placeholder="Full Name"
                                wire:model.defer="data.name">
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" aria-describedby="emailHelp" placeholder="Email address"
                                wire:model.defer="data.email">
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" placeholder="Password" wire:model.defer="data.password">
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="passwordConfirmation" placeholder="Confirm Password"
                                wire:model.defer="data.password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times mr-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>
                            @if ($editingUser)
                                <span>Save Changes</span>
                            @else
                                <span>Save</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!--Delete Confirmation Modal -->
    <div class="modal fade" id="confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <h6 class="mb-3">Are you sure to delete this user?</h6>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"> Cancel</button>
                    <button type="submit" class="btn btn-danger" wire:click.prevent="delete">Delete</button>
                </div>

            </div>
        </div>
    </div>

</div>
