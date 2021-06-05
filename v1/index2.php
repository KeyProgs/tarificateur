<script type="text/javascript">


    $.ajax({
        url: app_url + "get-tarificateur-formules/" + listeFormulesInput.val(),
        type: "POST",
        data: {'_token': _token, 'data': listeFormulesInput.val()},
        cache: false,
        success: function (data) {
            if (data.success) {
                alert('ok');
            }else {
                alert('Not  OK');
            }


        }

    });




