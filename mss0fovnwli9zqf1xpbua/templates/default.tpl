<!-- BEGIN center -->
    <div class="login-wrap">
      <div class="login-title">Панель управления сайтом</div>
      <div class="container-fluid">
        <form onsubmit="return false;">
          <div class="form-group row">
            <label class="col-5 col-form-label text-right">Логин:</label>
            <div class="col-5">
              <input class="form-control" type="text" id="login" name="login">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-5 col-form-label text-right">Пароль:</label>
            <div class="col-5">
              <input class="form-control" type="password" id="password" name="password">
            </div>
          </div>
          <div class="row page-button-block">
            <div class="col-4 offset-5">
              <button class="btn btn-primary btn-lg" onclick="makeRequest('auth','/mss0fovnwli9zqf1xpbua/js.php?type=auth&login='+document.getElementById('login').value+'&password='+document.getElementById('password').value); return false;">Войти</button>
            </div>
          </div>
        </form>
      </div>
    </div>
<!-- END center -->