@extends('app')

@section('content')

    <section class="py-5 text-center container import-page">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                @if($errors->any())
                    {!! implode('', $errors->all('
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Validation error!</strong> :message
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'
                    )) !!}
                @endif
                <h1 class="fw-light">Import</h1>

                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                </svg>
                <div class="alert alert-warning d-flex align-items-center err-notification" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div class="err-msg"></div>
                </div>
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div>
                        Input accepts CSV file type. Max size 2MB.
                        HTML inside of file may trigger validation error
                    </div>
                </div>
                <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" required accept=".csv" class="form-control" id="csv" aria-describedby="csv" aria-label="Upload">
                    </div>
                    <div class="container hidden-fields">
                        <h5 class="fw-light">Define fields map</h5>
                        @foreach ($map as $field => $label)
                            <div class="row default-fields">
                                <div class="col-6 col-sm-6">{{ $label }}</div>
                                <div class="col-6 col-sm-6">
                                    <select class="form-select form-select-sm" required name="{{ $field }}" aria-label=".form-select-sm example">
                                    </select>
                                </div>
                                <div class="w-100 d-none d-md-block"></div>
                            </div>
                        @endforeach
                        <div class="attributes"></div>
                        <a href="#" class="btn btn-link add-custom-field">Add custom field</a>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Import</button>
                </form>
            </div>
        </div>
    </section>
@endsection
