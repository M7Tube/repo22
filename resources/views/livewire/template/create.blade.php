<div>
    {{-- <a class="btn btn-primary mx-5 mt-2" href='{{ url()->previous() }}'>
                    <- back
                </a> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><a href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary"><i class="bi bi-skip-backward-fill"></i></a><span
                                class="mx-5">Create Template</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="create_template">
                            {{-- @csrf --}}
                            <div class="results">
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                            </div>
                            <div class="results">
                                @if (Session::get('message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputName" type="text"
                                            placeholder="Mohammed S" wire:model="template_name" autocomplete="off"
                                            value="{{ old('template_name') }}" />
                                        <span class="text-danger">
                                            @error('template_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <label for="inputName">Template Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputdesc" type="text"
                                            placeholder="Mohammed S" wire:model="template_desc" autocomplete="off"
                                            value="{{ old('template_desc') }}" />
                                        <span class="text-danger">
                                            @error('template_desc')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <label for="inputdesc">Template Description</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputinstructions" type="text"
                                            placeholder="Mohammed S" wire:model="template_instructions"
                                            autocomplete="off" value="{{ old('template_instructions') }}" />
                                        <span class="text-danger">
                                            @error('template_instructions')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <label for="inputinstructions">Template Instructions</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="file" id="inputTemplatePicture" autocomplete="off"
                                            wire:model="template_pic" class="form-control" placeholder="template_pic"
                                            value="{{ old('template_pic') }}">
                                        <span class="text-danger">
                                            @error('template_pic')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <label for="inputTemplatePicture">Logo</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">

                                        <div class="col-8">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputsignatures" type="text"
                                                    placeholder="Mohammed S" wire:model="signatures" autocomplete="off"
                                                    value="{{ old('signatures') }}" />
                                                <span class="text-danger">
                                                    @error('signatures')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                                <label for="inputsignatures">Template Signatures
                                                    #{{ count($signatures_arr) + 1 }}</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-block w-100 btn-outline-success btn-lg"
                                                wire:click.prevent="add_signatures">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" id="inputwith_visit_type" type="checkbox"
                                                placeholder="Mohammed S" wire:model="template_with_visit_type"
                                                autocomplete="off" value="{{ old('template_with_visit_type') }}" />
                                            <label for="inputdesc" class="form-check-label">With Visit Type</label>
                                        </div>
                                        <span class="text-danger">
                                            @error('template_with_visit_type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-success">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
