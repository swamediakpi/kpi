<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register KPI</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/css/animate.min.css" rel="stylesheet">
    
    <link href="/css/login.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/css/custom.min.css" rel="stylesheet">
    
    <script src="/js/jquery.min.js"></script>    

    <script src="/js/jquery.js"></script>

    <script src="/js/jquery-ui.js"></script>
    
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

  </head>

<body class="body-login">
<div class="container">
    <div class="card card-container" style="max-width: 600px;">
        <div class="panel-body">        
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('EMPLOYEE_ID') ? ' has-error' : '' }}">
                    <label for="EMPLOYEE_ID" class="col-md-4 control-label">NO Employee</label>

                    <div class="col-md-6">
                        <input id="EMPLOYEE_ID" type="number" min="0" class="form-control" name="EMPLOYEE_ID" value="{{ old('EMPLOYEE_ID') }}" required autofocus>

                        @if ($errors->has('EMPLOYEE_ID'))
                            <span class="help-block">
                                <strong>{{ $errors->first('EMPLOYEE_ID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('ROLE_ID') ? ' has-error' : '' }}">
                    <label for="jabatan" class="col-md-4 control-label">User Role</label>

                    <div class="col-md-6">
                        <select name="ROLE_ID" id="ROLE_ID" class="form-control">
                            <option value="">select user role</option>
                            <option value="1">HRD</option>
                            <option value="2">PMO</option>
                            <option value="3">UNIT</option>
                            <option value="4">Employee</option>
                            <option value="5">Admin</option>                             
                        </select>

                        @if ($errors->has('ROLE_ID'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ROLE_ID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('UNIT_ID') ? ' has-error' : '' }}">
                    <label for="UNIT_ID" class="col-md-4 control-label">Unit</label>

                    <div class="col-md-6">
                        <select name="UNIT_ID" id="UNIT_ID" class="form-control">
                            <option value="">select Unit</option>
                            <option value="1">BIM</option>
                            <option value="2">BILLING</option>
                            <option value="3">ERP</option>
                            <option value="4">EAI</option>
                            <option value="5">HRD</option>                              
                        </select>

                        @if ($errors->has('UNIT_ID'))
                            <span class="help-block">
                                <strong>{{ $errors->first('UNIT_ID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('EMPLOYEE_NAME') ? ' has-error' : '' }}">
                    <label for="EMPLOYEE_NAME" class="col-md-4 control-label">Employee Name</label>

                    <div class="col-md-6">
                        <input id="EMPLOYEE_NAME" type="text" class="form-control" name="EMPLOYEE_NAME" value="{{ old('EMPLOYEE_NAME') }}" required autofocus>

                        @if ($errors->has('EMPLOYEE_NAME'))
                            <span class="help-block">
                                <strong>{{ $errors->first('EMPLOYEE_NAME') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('EMPLOYEE_EMAIL') ? ' has-error' : '' }}">
                    <label for="EMPLOYEE_EMAIL" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="EMPLOYEE_EMAIL" type="email" class="form-control" name="EMPLOYEE_EMAIL" value="{{ old('EMPLOYEE_EMAIL') }}" required>

                        @if ($errors->has('EMPLOYEE_EMAIL'))
                            <span class="help-block">
                                <strong>{{ $errors->first('EMPLOYEE_EMAIL') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('EMPLOYEE_TITLE') ? ' has-error' : '' }}">
                    <label for="EMPLOYEE_TITLE" class="col-md-4 control-label">Employee Title</label>

                    <div class="col-md-6">
                        <input id="EMPLOYEE_TITLE" type="text" class="form-control" name="EMPLOYEE_TITLE" value="{{ old('EMPLOYEE_TITLE') }}" required autofocus>

                        @if ($errors->has('EMPLOYEE_TITLE'))
                            <span class="help-block">
                                <strong>{{ $errors->first('EMPLOYEE_TITLE') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-md-4 control-label">Username</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>                        
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>            
    </div>
</div>
</body>