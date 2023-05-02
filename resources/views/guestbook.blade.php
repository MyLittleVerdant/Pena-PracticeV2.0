<!DOCTYPE html>
<html>
<head>
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Guestbook Form</h2>
    <form action="/"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   placeholder="Enter name">
            @error('name')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="text">Text:</label>
            <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="3"
                      placeholder="Enter text"></textarea>
            @error('text')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="container mt-5">
    <table class="table table-hovered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Text</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @forelse($guests as $guest)
            <tr>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->text }}</td>
                <td>{{ $guest->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No records yet</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $guests->links('includes.pagination') }}
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
