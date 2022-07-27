<div>
    <div class="container-fluid">
        <div class="row justify-content-center mx-2">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><a href="{{ route('dashboard') }}"
                                class="btn btn-outline-secondary"><i class="bi bi-skip-backward-fill"></i></a><span
                                class="mx-5">New Form</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('form.store') }}" enctype='multipart/form-data' autocomplete="off"
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
                            <h5 class="text-secondary">
                               {{ $instruction }}
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        Site Name
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating mb-1">
                                                                            <input class="form-control" id="inputName"
                                                                                type="text" placeholder="Mohammed S"
                                                                                name="name" autocomplete="off"
                                                                                value="{{ $sitename }}" />
                                                                            <span class="text-danger">
                                                                                @error('name')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <label for="inputName">Site
                                                                                Name</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        Description
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating mb-1">
                                                                            <input class="form-control" id="inputName"
                                                                                type="text" placeholder="Mohammed S"
                                                                                name="desc" autocomplete="off" />
                                                                            <span class="text-danger">
                                                                                @error('desc')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <label for="inputdesc">Inspection
                                                                                Description</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        Date
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating mb-1">
                                                                            <input class="form-control" id="date"
                                                                                type="text" name="date"
                                                                                autocomplete="off"
                                                                                value="{{ date('Y-m-d H:i:s') }}"
                                                                                disabled />
                                                                            <span class="text-danger">
                                                                                @error('date')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <label for="date">The Inspection
                                                                                Creation
                                                                                Date</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-12 noselect">
                                                                        Location
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {{-- <p id="demo"></p> --}}
                                                                        <div class="form-floating mb-1">
                                                                            <input class="form-control" id="demo"
                                                                                type="text" placeholder="Mohammed S"
                                                                                name="location" autocomplete="off"
                                                                                disabled />
                                                                            <span class="text-danger">
                                                                                @error('location')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <label for="inputlocation">
                                                                                Location</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-12 noselect">
                                                                        Document NO.
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating mb-1">
                                                                            <div class="input-group input-group-lg">
                                                                                <span class="input-group-text"
                                                                                    id="inputGroup-sizing-lg">Doc.</span>
                                                                                <input class="form-control "
                                                                                    id="inputdocNo" type="text"
                                                                                    name="docNo" autocomplete="off"
                                                                                    value="{{ $docNo }}"
                                                                                    disabled />
                                                                                <span class="text-danger">
                                                                                    @error('docNo')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        @forelse ($att as $kkkey => $attt)
                                            {{--  --}}

                                            <div class="accordion accordion-flush mb-5 mt-5"
                                                id="accordionFlushExample{{ $kkkey }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header"
                                                        id="flush-headingOne{{ $kkkey }}">
                                                        <button
                                                            class="accordion-button {{ $kkkey != 0 ? 'collapsed' : '' }}"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseOne{{ $kkkey }}"
                                                            aria-expanded="false"
                                                            aria-controls="flush-collapseOne{{ $kkkey }}">
                                                            {{ $attt->name }}
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseOne{{ $kkkey }}"
                                                        class="accordion-collapse collapse {{ $kkkey == 0 ? 'show' : '' }}"
                                                        aria-labelledby="flush-headingOne{{ $kkkey }}"
                                                        data-bs-parent="#accordionFlushExample{{ $kkkey }}">
                                                        <div class="accordion-body">
                                                            <h4 class="text-center">{{ $attt->name }}</h4>
                                                            @forelse ($attt['att'] as $kkey=> $at)
                                                                <div class="my-2 col-12">
                                                                    <div
                                                                        class="Scard card shadow-lg border-2 rounded-lg">
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <div class="media">
                                                                                    <div class="media-body text-right">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                {{-- <input type="hidden" name="at[{{$kkey}}]key"
                                                                                value="{{ $at->name }}"> --}}
                                                                                                <h3>{{ $at->name }}
                                                                                                </h3>
                                                                                                @forelse ($at->status as $key => $st)
                                                                                                    @if ($st['key'] != null && $st['value'] != null)
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            class="btn-check w-100"
                                                                                                            name="at[{{ 0 }}][{{ $attt->name }}][{{ $at->name }}][value]"
                                                                                                            value="{{ $st['key'] }}\./{{ $st['value'] }}"
                                                                                                            id="option{{ $kkkey }}{{ $kkey }}{{ $key }}"
                                                                                                            autocomplete="off">
                                                                                                        <label
                                                                                                            class="btn btn-outline-{{ $st['value'] }} w-100 my-1"
                                                                                                            for="option{{ $kkkey }}{{ $kkey }}{{ $key }}">{{ $st['key'] }}</label>
                                                                                                        @if ($st['value'] == 'warning')
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-floating mb-1">
                                                                                                                    <input
                                                                                                                        class="form-control"
                                                                                                                        id="inputReason"
                                                                                                                        type="text"
                                                                                                                        placeholder="Is Not working becuse ....."
                                                                                                                        name="at[{{ 0 }}][{{ $attt->name }}][{{ $at->name }}][reason]"
                                                                                                                        autocomplete="off"
                                                                                                                        style="background-color : #ffe3a8 " />
                                                                                                                    <span
                                                                                                                        class="text-danger">
                                                                                                                        @error('Reason')
                                                                                                                            {{ $message }}
                                                                                                                        @enderror
                                                                                                                    </span>
                                                                                                                    <label
                                                                                                                        for="inputReason">Case
                                                                                                                        Description
                                                                                                                        <i
                                                                                                                            class="bi bi-file-easel"></i></label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                        @forelse ($at->dateAndTime as $date)
                                                                                                            @if ($key == $date['attrubite_value_key'])
                                                                                                                <label
                                                                                                                    for="inputlocation">
                                                                                                                    {{ $date['title'] }}</label>
                                                                                                                <input
                                                                                                                    class="form-control"
                                                                                                                    id="inputdocNo"
                                                                                                                    type="date"
                                                                                                                    name="at[{{ 0 }}][{{ $attt->name }}][{{ $at->name }}][{{ $date['title'] }}]"
                                                                                                                    autocomplete="off"
                                                                                                                    {{ $date['is_required'] == 1 ? 'required' : '' }} />
                                                                                                                <span
                                                                                                                    class="text-danger">
                                                                                                                    @error('dateAndTime')
                                                                                                                        {{ $message }}
                                                                                                                    @enderror
                                                                                                                </span>
                                                                                                            @endif
                                                                                                        @empty
                                                                                                        @endforelse
                                                                                                        {{-- <input type="hidden"
                                                                                        name="at[{{ 0 }}][{{ $at->name }}][color]"
                                                                                        value="{{ $st['value'] }}"> --}}
                                                                                                        <br>
                                                                                                        {{-- <input type="hidden" name="at[{{ $kkey }}][color]" value="{{ $st['value'] }}"> --}}
                                                                                                    @else
                                                                                                    @endif
                                                                                                @empty
                                                                                                    empty
                                                                                                @endforelse
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                {{-- <h5 class="text-center text-muted">Empty Questions</h5> --}}
                                                            @endforelse
                                                            <hr>
                                                            @forelse ($attt['selector'] as $kkkeyy=> $stt)
                                                                <div class="my-2 col-12">
                                                                    <div
                                                                        class="Scard card shadow-lg border-2 rounded-lg">
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <div class="media">
                                                                                    <div class="media-body text-right">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                {{ $stt['name'] }}
                                                                                                <select
                                                                                                    class="form-control"
                                                                                                    name="selection[{{ 0 }}][{{ $attt->name }}][{{ $stt['name'] }}][{{ $kkkeyy }}]"
                                                                                                    id="">
                                                                                                    <option
                                                                                                        value="0">
                                                                                                        Choose Form
                                                                                                        <b>{{ $stt['name'] }}</b>
                                                                                                    </option>
                                                                                                    @forelse (explode(',', $stt['values']) as $keey => $data)
                                                                                                        <option
                                                                                                            value="{{ $data }}">
                                                                                                            {{ $data }}
                                                                                                        </option>

                                                                                                    @empty
                                                                                                    @endforelse
                                                                                                </select>
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
                                                            <hr>
                                                            @forelse ($attt['textbox'] as $kkkeey=> $tebx)
                                                                <div class="my-2 col-12">
                                                                    <div
                                                                        class="Scard card shadow-lg border-2 rounded-lg">
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <div class="media">
                                                                                    <div class="media-body text-right">
                                                                                        <div class="row">

                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div
                                                                                                    class="form-floating mb-1">
                                                                                                    <input
                                                                                                        class="form-control"
                                                                                                        id="inputName"
                                                                                                        type="text"
                                                                                                        placeholder="Mohammed S"
                                                                                                        name="textbox[{{ 0 }}][{{ $attt->name }}][{{ $tebx['name'] }}][{{ $kkkeey }}]"
                                                                                                        autocomplete="off" />
                                                                                                    <span
                                                                                                        class="text-danger">
                                                                                                        @error('name')
                                                                                                            {{ $message }}
                                                                                                        @enderror
                                                                                                    </span>
                                                                                                    <label
                                                                                                        for="inputName">{{ $tebx['name'] }}</label>
                                                                                                </div>
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
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            {{--  --}}

                                        @empty
                                            <h4 class="text-center">Empty</h4>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            {{-- <form wire:submit.prevent="save"> --}}
                            {{-- <hr> --}}
                            {{-- <div class="row">
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
                                    <input type="file" id="photos" class="form-control" name="photos" multiple>
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
                            </div> --}}
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
                            <button type="submit" class="btn btn-outline-success">Next <i
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
