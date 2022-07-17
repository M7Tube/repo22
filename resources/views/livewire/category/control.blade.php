<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Category Table</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Template</th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categoris as $category)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $category->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            {{ $category->template->name }}
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal"
                                            data-bs-target="#editcategoryModal"
                                            wire:click.prevent="edit({{ $category->category_id }})">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="editcategoryModal" tabindex="-1"
        aria-labelledby="editcategoryModallabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editcategoryModalText">Edit
                        Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click.prevent="clear()"></button>
                </div>
                <div class="modal-body">
                    @if (Session()->has('WrongCategory'))
                        <div class="alert alert-danger">
                            {{ Session('WrongCategory') }}
                        </div>
                    @endif
                    @if (!Session()->has('WrongCategory'))
                        <div class="card-body">
                            <form autocomplete="off" method="POST">
                                @csrf
                                <input type="hidden" name="category_id" wire:model="category_id">
                                <div class="results">
                                    @if (Session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ Session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="InputName" type="text" name="name"
                                                autocomplete="off" wire:model="name" />
                                            <label for="inputName">Name</label>
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select wire:model="template_id" id="" class="form-control">
                                                @forelse ($templates as $template)
                                                    <option value="{{ $template->template_id }}">
                                                        {{ $template->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <label for="inputName">Template</label>
                                            <span class="text-danger">
                                                @error('template_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click.prevent="clear()">Close</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="delete()">Delete</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
    {!! $categoris->links() !!}
</div>
