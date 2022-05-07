<div>
    <div class="container-fluid">
        <div class="row justify-content-center mx-2">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><a href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary"><i class="bi bi-skip-backward-fill"></i></a><span
                                class="mx-5">Complate Form</span>
                    </div>
                    <div class="card-body">
                        {{-- {{session()->get('LoggedAccount')['email']}} --}}
                        <form action="{{ route('Exportform.post') }}" enctype='multipart/form-data' autocomplete="off"
                            method="POST">
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
                            <input type="hidden" name="user_id"
                                value="{{ session()->get('LoggedAccount')['user_id'] }}">

                            <form wire:submit.prevent="save">
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center text-muted">
                                            Picture From The Site
                                        </h4>
                                    </div>
                                </div>
                                @error('photos.*')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                @if (Session::get('messageFile'))
                                    <div class="alert alert-success">
                                        {{ Session::get('messageFile') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <input type="file" id="photos" class="form-control" wire:model="photos"
                                            multiple>
                                    </div>
                                    <div class="col-md-6 mt2">
                                        @if ($photos)
                                            <div class="row">
                                                @forelse ($photos as $key => $photo)
                                                    <div class="col-12 col-md-6 mt-2">
                                                        <div class="Scard card shadow-lg border-2 rounded-lg">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="media">
                                                                        <div class="media-body text-right">
                                                                            <div class="row">
                                                                                Photo {{ $key + 1 }}
                                                                                <div class="col-12 col-md-6">
                                                                                    <img src="{{ $photo->temporaryUrl() }}"
                                                                                        width="100px">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        @endif
                                    </div>
                                </div>
                    </div>
                    <hr>
                    {{-- <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center text-muted">
                                    Choose Signture To Add
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            @forelse ($signture as $SignKey => $sign)
                                <div class="col-md-6 mx-2">
                                    <input type="radio" class="btn-check w-100 mt-2"
                                        name="signture[{{ $SignKey }}]" value="{{ $sign['signature'] }}"
                                        id="signture[{{ $SignKey }}]" autocomplete="off">
                                    <label class="btn btn-outline-secondary w-100 my-1 mt-2"
                                        for="signture[{{ $SignKey }}]">{{ $sign['name'] }}</label>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center text-danger">
                                            There Is No Signtures
                                        </h4>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <hr> --}}
                    <div class="m-4">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-primary">Export <i
                                    class="bi bi-arrow-bar-right"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
