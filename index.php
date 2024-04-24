<?php
require 'db.php';
require 'validCities.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
    <script type="text/javascript">
    const validCities = [
    <?php
    forEach($cities as $city){
    echo "'".$city['key']."',";
    } ?>
    ];
    function send () {
    
    const formElement = document.getElementsByTagName('form');
    const formData = new FormData(formElement[0]);
    const email = formData.get('email');
    const name = formData.get('name');
    const phone = formData.get('phone');
    const city = formData.get('city');
    const token = '<?php echo $token?>';
    if(validateEmail(email) && validateName(name) && validatePhone(phone) && validateCity(city))
    $.ajax({
    url: '/addlid.php',
    method: 'POST',
    dataType: 'html',
    data: {
    email: email,
    name: name,
    phone: phone,
    city: city,
    token: token
    },
    success: function(data){
    alert(data);
    }
    });
    }
    function validateEmail(email){
    const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
    const valid = EMAIL_REGEXP.test(email);
    if(!valid) alert("Неверный email");
    return valid;
    }
    function validatePhone(phone){
    const PHONE_REGEXP = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    const valid = PHONE_REGEXP.test(phone);
    if(!valid) alert("Неверный телефон");
    return valid;
    }
    function validateName(name){
    const NAME_REGEXP = /^[а-яА-Я]+$/;
    const valid = NAME_REGEXP.test(name.split(' ').join(''));
    return valid;
    }
    function validateCity(city){
    return validCities.indexOf(city) !== -1;
    }
    
    </script>
    <title></title>
  </head>
  <body>
    <div class="container">
      <div class="row mx-0 justify-content-center">
        <div class="col-md-7 col-lg-5 px-lg-2 col-xl-4 px-xl-0 px-xxl-3">
          <!-- <form method="POST" class="w-100 rounded-1 p-4 border bg-white" action="https://herotofu.com/start"> -->
          <form class="w-100 rounded-1 p-4 border bg-white">
            
            <label class="d-block mb-4">
              <span class="form-label d-block">Email</span>
              <input
              name="email"
              type="email"
              class="form-control"
              placeholder="dglemingg@gmail.com"
              required
              />
            </label>
            <label class="d-block mb-4">
              <span class="form-label d-block">ФИО</span>
              <input name="name" type="test" class="form-control" placeholder="Зайцев Кирилл Александрович" required />
            </label>
            <label class="d-block mb-4">
              <span class="form-label d-block">Телефон</span>
              <input name="phone" type="phone" class="form-control" placeholder="+79028465203" required />
            </label>
            <label class="d-block mb-4">
              <span class="form-label d-block">Город</span>
              <select class="form-select" name="city">
                <?php
                forEach($cities as $city){
                echo '<option value="'.$city['key'].'">'.$city['val'].'</option>';
                } ?>
              </select>
            </label>
            <div class="mb-3">
              <button class="btn btn-primary px-3 rounded-3" type="button" onclick="send()">
              Отправить
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>