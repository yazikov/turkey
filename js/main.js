$().ready(function() {

    $('.fancybox').fancybox();

    $('#btnSearch').click(function() {
        var text = "";
        var country = $("#inputCountry option:selected").val();
        if (country != 0) {
            if (text != "") {
                text += "&";
            }
            text += "country="+country;
        }
        var city = $("#inputCity option:selected").val();
        if (city != 0) {
            if (text != "") {
                text += "&";
            }
            text += "city="+city;
        }
        var type = $("#inputType option:selected").val();
        if (type != 0) {
            if (text != "") {
                text += "&";
            }
            text += "type="+type;
        }
        var houseType = $("#inputHouseType option:selected").val();
        if (houseType != 0) {
            if (text != "") {
                text += "&";
            }
            text += "htype="+houseType;
        }
        var minc = $("#inputCostMin option:selected").val();
        if (minc != 0) {
            if (text != "") {
                text += "&";
            }
            text += "minc="+minc;
        }
        var maxc = $("#inputCostMax option:selected").val();
        if (maxc != 0) {
            if (text != "") {
                text += "&";
            }
            text += "maxc="+maxc;
        }
        var minr = $("#inputRoomMin option:selected").val();
        if (minr != 0) {
            if (text != "") {
                text += "&";
            }
            text += "minr="+minr;
        }
        var maxr = $("#inputRoomMax option:selected").val();
        if (maxr != 0) {
            if (text != "") {
                text += "&";
            }
            text += "maxr="+maxr;
        }
        if ($('#inputParking').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "p=1";
        }
        if ($('#inputSwimmingPool').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "s=1";
        }
        if ($('#inputFurniture').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "f=1";
        }
        if ($('#inputWasher').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "w=1";
        }
        if ($('#inputRefrigerator').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "r=1";
        }
        if ($('#inputKitchenRange').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "k=1";
        }
        if ($('#inputMicrowave').is(":checked")) {
            if (text != "") {
                text += "&";
            }
            text += "m=1";
        }
        var request = "/houses.php";
        if (text != "") {
            request += "?" + text;
        }

        window.location.href = request;
    });

    $("#inputCountry").change(function() {
        var val = $("#inputCountry option:selected").val();
        var text = '<option value="0" selected>Город</option>';
        if (val == 0) {
            $.each(countrys, function(index_citys, citys){
                $.each(citys, function(index, value){
                    text += '<option value="'+ index +'">'+ value +'</option>';
                });
            });
        } else {
            var citys = countrys[val];
            $.each(citys, function(index, value){
                text += '<option value="'+ index +'">'+ value +'</option>';
            });
        }
        $("#inputCity").html(text);
    });
});