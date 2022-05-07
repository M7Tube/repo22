<div id="app">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-fluid">
                <div class="row justify-content-center mx-2">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <div class="row">
                                    <h3 class="text-center font-weight-light my-4">Questions Table</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input wire:model.debounce.300ms="search" type="text"
                                                class="form-control mb-3" placeholder="Search Here">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" wire:model="orderBy">
                                                    <option value="name">Name</option>
                                                </select>
                                                <label for="ChooseOrderCoulmn">Order By Coulmn</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" wire:model="orderAsc">
                                                    <option value="1">Ascending</option>
                                                    <option value="0">Descending</option>
                                                </select>
                                                <label for="ChooseOrderType">Order Type</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="datatablesSimple" class="table table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Template</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($categoris as $category)
                                                    <tr>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->template->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editcategoryModal"
                                                                wire:click.prevent="edit({{ $category->category_id }})"><i
                                                                    class="bi bi-pen"></i></button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="30">
                                                            <h4 class="text-center text-muted">Empty</h4>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div wire:ignore.self class="modal fade" id="editcategoryModal" tabindex="-1"
                                        aria-labelledby="editcategoryModallabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editcategoryModalText">Edit
                                                        Questions</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close" wire:click.prevent="clear()"></button>
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
                                                                <input type="hidden" name="category_id"
                                                                    wire:model="category_id">
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
                                                                            <input class="form-control" id="InputName"
                                                                                type="text" name="name"
                                                                                autocomplete="off" wire:model="name" />
                                                                            <label for="inputName">Name</label>
                                                                            <span class="text-danger">@error('name')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                        wire:click.prevent="clear()">Close</button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click.prevent="delete()">Delete</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        wire:click.prevent="update()">Save
                                                        Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! $categoris->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
