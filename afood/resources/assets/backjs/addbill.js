$(function(){
    $('#bill').blur(function(){
    var Bill=$(this);
     var Data=Bill.val().split('*');
    $.ajax({
        url:'https://bird.ioliu.cn/v2?url=http://www.bilibili.com/index/ding.json',
        type:'get',
        dataType:'json',
        crossDomain:true,
        success:function(data){

            var data=eval('data.'+Data[0]);
           for(var i=0;i<10;i++){
               if(i==Data[1])
               {
                   data=data[0];
               }
           }

            $('#aid').val(data.aid)
            $('#cate').val(Data[0])
            $('#tname').val(data.tname)
            $('#title').val(data.title)
            $('#ctime').val(data.ctime)
            $('#desc').val(data.desc)
            $('#Duration').val(data.duration)
            $('#name').val(data.owner.name)
            $('#face').val(data.owner.face)
            $('#pic').val(data.pic)
            $('#coin').val(data.stat.coin)
            $('#favorite').val(data.stat.favorite)
            $('#view').val(data.stat.view)
        }

    })

    })
});