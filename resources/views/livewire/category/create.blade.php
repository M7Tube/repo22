<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><span class="mx-5">Create New Category</span>
                            {{-- <a href="/"
                                class="btn btn-outline-secondary"><i class="bi bi-skip-forward-fill"></i> Login</a></h3> --}}
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="create">
                            @csrf
                            <div class="results">
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                            </div>
                            <div class="results">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputName" type="text"
                                            placeholder="Fire Alarm" wire:model="name" autocomplete="off"
                                            value="{{ old('name') }}" />
                                        <span class="text-danger">@error('name')
                                                {{ $message }}
                                            @enderror</span>
                                        <label for="inputName">Category Name</label>
                                    </div>
                                </div>
                                <input type="hidden" wire:model="template_id" value="{{ request()->query('template_id') }}">
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-success">Create <i class="bi bi-file-plus"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
