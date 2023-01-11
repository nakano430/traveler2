
$('.event').slick({
    autoplay: true,         //自動再生
    autoplaySpeed: 3000,    //自動再生のスピード
    speed: 900,	            //スライドするスピード
    dots: true,             //スライドしたのドット
    arrows: true,           //左右の矢印
    infinite: true,         //スライドのループ
});


$(function(){
    // まずBを全部非表示にする
    $('.small_input > option[data-id]').wrap('<span>');

    $('.large_input').change(function () {
        // Aが変更されるときに一度非表示にする
        $('.small_input > option[data-id]').wrap('<span>');
        // Aのvalueに対応するBのdata-idのoptionを表示する
        $(".small_input option[data-id='" + $('.large_input').val() + "']").unwrap();
    });
});

$(function(){
    //都道府県 が変更された場合
    $('[name=prefecture]').on('change', function(){
        //idが一桁の時はゼロうめする
        // var prefecture_id = ('00' + $(this).val()).slice(-2);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/ajax/city",
            data: { "prefecture_id": prefecture_id },
            dataType: "json"
        }).done(function (data) {
            //selectタグ（子） の option値 を一旦削除
            $('#city option').remove();
            //戻って来た data の値をそれそれ optionタグ として生成し、
            // city に optionタグ を追加する
            $.each(data['data'], function (id) {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
            });
            
 
        }).fail(function () {
            console.log("失敗");
        });
    });
});


$(function(){
    $("#delete_button").click(function(){
        $.confirm({"message":"削除しますか？",
            "buttons":{
                "はい":{"action": function(){
                    // ダイアログを閉じる
                    return true;
                }},
                "キャンセル":{"action": function(){
                    // ダイアログを閉じる
                    return false;
                }}
            }
        });
    });
});

