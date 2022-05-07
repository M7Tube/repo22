<div id="app">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-fluid">
                <div class="row justify-content-center mx-2">
                    <div class="col-lg-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <div class="row">
                                    <h3 class="text-center font-weight-light my-4">Template Table</h3>
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
                                                    <th>Icon</th>
                                                    <th>User</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($templates as $template)
                                                    <tr>
                                                        <td>{{ $template->name }}</td>
                                                        @if (is_null($template->pic))
                                                            <td><i class="bi bi-file-earmark-bar-graph"></i></td>
                                                        @else
                                                            <td><img src="{{ $template->pic }}" alt="Icon" width="30px"></td>
                                                        @endif
                                                        <td><span class="text-muted">Created By </span>{{ $template->user->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edittemplateModal"
                                                                wire:click.prevent="edit({{ $template->template_id }})">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div wire:ignore.self class="modal fade" id="edittemplateModal" tabindex="-1"
                                        aria-labelledby="edittemplateModallabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edittemplateModalText">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close" wire:click.prevent="clear()"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if (Session()->has('WrongUser'))
                                                        <div class="alert alert-danger">
                                                            {{ Session('WrongUser') }}
                                                        </div>
                                                    @endif
                                                    @if (!Session()->has('WrongUser'))
                                                        <div class="card-body">
                                                            <form autocomplete="off" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    wire:model="user_id">
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
                                                                            <input class="form-control"
                                                                                id="InputTemplateName" type="text"
                                                                                name="name"
                                                                                autocomplete="off"
                                                                                wire:model="name" />
                                                                            <label for="inputTemplateName">Template
                                                                                Name</label>
                                                                            <span
                                                                                class="text-danger">@error('name')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="InputTemplatePicture" type="file"
                                                                                name="pic" autocomplete="off" wire:model="pic" />
                                                                            <span class="text-danger">@error('pic')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                            <label for="InputTemplatePicture">Template Icon</label>
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
                                    {!! $templates->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
