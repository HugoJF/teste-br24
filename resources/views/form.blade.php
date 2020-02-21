@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="row justify-content-center">

                <h2 class="m-3 text-center">Registro de contato</h2>
                
                @include('flash::message')

                {!! Form::open(['method' => 'POST', 'route' => 'store']) !!}
                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name">Nome</label>
                        <input
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>


                    <!-- Surname -->
                    <div class="col-md-6 mb-3">
                        <label for="name">Sobrenome</label>
                        <input
                            id="surname"
                            class="form-control @error('Sobrenome') is-invalid @enderror"
                            name="surname"
                            type="text"
                            value="{{ old('surname') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            @error('surname')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Phone -->
                <div class="row mb-3">
                    <!-- CPF -->
                    <div class="col-md-6 mb-3">
                        <label for="cpf">CPF</label>
                        <input
                            id="cpf"
                            class="form-control @error('cpf') is-invalid @enderror"
                            name="cpf"
                            type="text"
                            value="{{ old('cpf') }}"
                            data-mask="cpf"
                            required
                        >
                        <div class="invalid-feedback">
                            @error('cpf')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Telefone</label>
                        <input
                            id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            name="phone"
                            type="text"
                            value="{{ old('phone') }}"
                            data-mask="phone"
                            required
                        >
                        <div class="invalid-feedback">
                            @error('phone')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                    >
                    <div class="invalid-feedback">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Company -->
                    <div class="col-md-6 mb-3">
                        <label for="company">Empresa</label>
                        <input
                            id="company"
                            class="form-control @error('company') is-invalid @enderror"
                            name="company"
                            type="text"
                            value="{{ old('company') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            @error('company')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <!-- CNPJ -->
                    <div class="col-md-6 mb-3">
                        <label for="cnpj">CNPJ</label>
                        <input
                            id="cnpj"
                            class="form-control @error('cnpj') is-invalid @enderror"
                            name="cnpj"
                            type="text"
                            value="{{ old('cnpj') }}"
                            data-mask="cnpj"
                            required>
                        <div class="invalid-feedback">
                            @error('cnpj')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="mb-4">

                <button class="btn btn-primary btn-lg btn-block" type="submit">Registrar</button>
                {!! Form::close() !!}
            </div>
            <div class="mt-5 row justify-content-center">
                <h2>Registros</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>CNPJ</th>
                        <th>Empresa</th>
                        <th>Contatos</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td><code>{{ $company->cnpjFormatted }}</code></td>
                            <td>{{ $company->name }}</td>
                            <td>
                                @foreach ($company->contacts as $contact)
                                    <p title="{{ $contact->cpfFormatted }}">{{ $contact->name }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
