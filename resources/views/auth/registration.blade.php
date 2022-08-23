
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col md-offset-4" style="margin-top:20px;">
            <h4>Registration</h4>  
            <hr>  
                <form action="{{route('register-user')}}" method="post">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('failed'))
                    <div class="alert alert-danger">
                        {{Session::get('failed')}}  
                    </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name"> Full Name</label>
                        <input type="text" class="form-control" placeholder="Enter your full name" name="name"
                        value="{{old('name')}}">
                        <span class="text-danger">@error('name'){{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="email"> Email</label>
                        <input type="text" class="form-control" placeholder="Enter your email" name="email"
                        value="{{old('email')}}">
                        <span class="text-danger">@error('email'){{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="password"> Password</label>
                        <input type="password" class="form-control" placeholder="Enter your password" name="password"
                        value="">
                        <span class="text-danger">@error('password'){{$message}} @enderror</span>
                    </div>

<label for="role">Register as: </label>
<select class="form-control" name="role">
<option value="" disabled>Select a Role</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>

</select>


                    <br>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Register</button>
                    </div>
                    <br>
                    <a href="login"> Already registered? Login Here</a>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</html>