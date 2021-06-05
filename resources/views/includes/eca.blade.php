<script type="text/javascript">


    $.ajax({
        url: "https://services.eca-assurances.com/mimenteSelf/SelfCreationContactSanteServiceImpl?wsdl",
        type: "POST",
        data: {'_token': _token, 'data': "", 'username': '', 'password': ''},
        cache: false,
        success: function (data) {
            if (data.success) {
                alert('ok');
            }else {
                alert('Not  OK');
            }


        }

    });




