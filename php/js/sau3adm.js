$('.edituser').on('click',function(){
    var a=$(this).attr('data-id')

    $.ajax({
        type:'POST'
      , url:'sau-admin/admin.process.php'
      , data:'process=1&usuario='+a
      , beforeSend:function(){
            $('#data-append').html(' ');
        }
      , success:function(a){
            $('#data-append').html(a);
            $('#myModal').modal('show');

            $('.cambiardatosuser').on('click',function(){
                jQuery.validator.setDefaults({
                    debug:!0
                  , success:'valid'
                });

                var a=$('#frmeditusr')

                a.validate({
                    rules:{
                        nombre:'required'
                      , apellido:'required'
                      , permalink:'required'
                      , activo:'required'
                      , rango:'required'
                    }
                });

                if(1==a.valid()){
                    var d=$('#frmeditusr')
                      , a='process=2&'+d.serialize()
                      , b=$(this)

                    $.ajax({
                        type:'POST'
                      , url:'sau-admin/admin.process.php'
                      , data:a
                      , beforeSend:function(){
                            d.hide();
                            b.hide();
                            d.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
                        }
                      , success:function(){
                            /*$('#loadingloader').remove();
                            d.show();
                            b.show();*/
                            location.reload(false);
                        },
                        error:function(){}
                    });
                }
            });

            $('.deleteimguser').on('click',function(){
                var a=$(this).attr('data-user')

                $.ajax({
                    type:'POST'
                  , url:'sau-admin/admin.process.php'
                  , data:'process=3&usuario='+a
                  , beforeSend:function(){
                        $('#imageprofilechange').addClass('opacityimgload');
                        $('#imageprofilechange').parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
                    }
                  , success:function(a){
                        /*$('#loadingloader').remove();
                        $('#imageprofilechange').attr('src', 'img/profile-normal.png');
                        $('#imageprofilechange').removeClass('opacityimgload');*/
                        location.reload(false);
                    }
                  , error:function(){}
                })
            });

            $('.changeimguser').on('click',function(){
                $('#changeprofile').click();
            });

            $('#changeprofile').change(function(){
                var pesoimg=this.files[0].size

                if(2<(pesoimg/1048576).toFixed(2)) $('#alertimg').show(),setTimeout(function(){
                    $('#alertimg').fadeOut(1E3)
                },3E3),$(this).val('');
                else{
                    var a=new FormData($('#profileserialize')[0]);
                    $.ajax({
                        url:'sau-admin/admin.process.php'
                      , type:'POST'
                      , data:a
                      , cache:!1
                      , contentType:!1
                      , processData:!1
                      , beforeSend:function(){
                            $('#imageprofilechange').addClass('opacityimg');
                            $('#imageprofilechange').parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>')
                        }
                      , success:function(a){
                            /*1 == a ? ($('#alertimg').show(), setTimeout(function() {
                                $('#alertimg').fadeOut(1E3)
                            }, 3E3)) : ($('#imageprofilechange').attr('src', a), $('#imageprofilechange').removeClass('opacityimg'), $('#loadingloader').remove());
                            $(this).val('');*/
                            location.reload(false);
                        }
                      , error:function(){}
                    })
                }
            });

            $('.changeuserpassadm').on('click',function(){
                jQuery.validator.setDefaults({
                    debug:!0
                  , success:'valid'
                });

                var a=$('#userchangepass')

                a.validate({
                    rules:{
                        newpassword:'required'
                      , passtwo:{
                            equalTo:'#newpassequal'
                          , required:!0
                        }
                    }
                });

                if(1==a.valid()){
                    var b='process=5&'+$('#userchangepass').serialize()
                      , c=$(this)

                    $.ajax({
                        type:'POST'
                      , url:'sau-admin/admin.process.php'
                      , data:b
                      , beforeSend:function(){
                            a.hide();
                            c.hide();
                            a.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
                        }
                      , success:function(b){
                            /*$('#loadingloader').remove();
                            $('#userchangepass')[0].reset();
                            c.show();
                            a.show();*/
                            location.reload(false);
                        }
                      , error:function(){}
                    });
                }
            });

            $('.cambiaremailadmbutton').on('click',function(){
                jQuery.validator.setDefaults({
                    debug:!0
                  , success:'valid'
                });

                var a=$('#changeemailadm')

                a.validate({
                    rules:{
                        email:{
                            required:!0
                          , email:!0
                        }
                    }
                });

                if(1==a.valid()){
                    var b=$('#changeemailadm')
                      , a='process=16&'+b.serialize()
                      , c=$(this)

                    $.ajax({
                        type:'POST'
                      , url:'sau-admin/admin.process.php'
                      , data:a
                      , beforeSend:function(){
                            b.hide();
                            c.hide();
                            b.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>')
                        }
                      , success:function(a){
                            /*$('#loadingloader').remove();
                            b.show();
                            c.show();*/
                            location.reload(false);
                        }
                      , error:function(){}
                    });
                }
            });
        },
        error:function(){}
    });
});

$('.crearnuevousuario').on('click',function(){
    jQuery.validator.setDefaults({
        debug:!0
      , success:'valid'
    });

    var a=$('#newuseradminfrm')

    a.validate({
        rules:{
            nombre:'required'
          , apellido:'required'
          , email:'required'
          , contrasena:'required'
          , activo:'required'
          , rango:'required'
        }
    });

    if(1==a.valid()){
        var b=$('#newuseradminfrm')
          , a='process=6&'+b.serialize()
          , e=$(this)

        $.ajax({
            type:'POST'
          , url:'sau-admin/admin.process.php'
          , data:a
          , beforeSend:function(){
                b.hide();
                e.hide();
                b.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>')
            }
          , success:function(){
                /*$('#loadingloader').remove();
                b.show();
                e.show();
                $('#NewUserModal').modal('toggle');
                b[0].reset();*/
                location.reload(false)
            }
          , error:function(){}
        });
    }
});

$('.deleteuser').on('click',function(){
    var a=$(this).attr('data-id')
      , yes=confirm('Esta seguro que desea eliminar el elemento?')

    if(yes){
        $.ajax({
            type:'POST'
          , url:'sau-admin/admin.process.php'
          , data:'process=7&usuario='+a
          , beforeSend:function(){
                $('#trusuario'+a).addClass('opacityimgload');
            }
          , success:function(b){
                $('#trusuario'+a).remove();
            }
          , error:function(){}
        });
    }
});

$('.editpublicacion').on('click',function(){
    var a=$(this).attr('data-id')

    $.ajax({
        type:'POST'
      , url:'sau-admin/admin.process.php'
      , data:'process=8&publicacion='+a
      , beforeSend:function(){
            $('#data-append').html(' ');
            $('#trpublicacion'+a).addClass('opacityimgload');
        }
      , success:function(b){
            $('#data-append').html(' ');
            $('#trpublicacion'+a).removeClass('opacityimgload');
            $('#data-append').append(b);
            $('#myModal').modal('show');
            $('.savepublicacion').on('click',function(){
                jQuery.validator.setDefaults({
                    debug:!0,
                    success:'valid'
                });

                var a=$('#publicacioneditfrm')

                a.validate({
                    rules:{
                        publicacion:'required'
                    }
                });

                if(1==a.valid()){
                    var b=$('#publicacioneditfrm')
                      , a='process=9&'+b.serialize()
                      , c=$(this)

                    $.ajax({
                        type:'POST'
                      , url:'sau-admin/admin.process.php'
                      , data:a
                      , beforeSend:function(){
                            b.hide();
                            c.hide();
                            b.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>')
                        }
                      , success:function(){
                            /*$('#loadingloader').remove();
                            b.show();
                            c.show();
                            $('#myModal').modal('toggle');*/
                            location.reload(false);
                        }
                      , error:function(){}
                    })
                }
            })
        }
      , error:function(){}
    })
});

$('.deleteaplicacion').on('click',function(){
    var a=$(this).attr('data-id')
      , yes=confirm('Esta seguro que desea eliminar el elemento?');

    if(yes){
        $.ajax({
            type:'POST'
          , url:'sau-admin/admin.process.php'
          , data:'process=10&publicacion='+a
          , beforeSend:function(){
                $('#trpublicacion'+a).addClass('opacityimgload');
            }
          , success:function(b){
                $('#trpublicacion'+a).remove();
            }
          , error:function(){}
        })
    }
});

$(".enviarmensajetodosbtn").on("click", function() {
    jQuery.validator.setDefaults({
        debug: !0,
        success: "valid",
        ignore: []
    });
    var a = $("#messagesfrmall");
    a.validate({
        rules: {
            asunto: "required",
            mensaje: "required"
        },
        messages: {
            asunto: "Campo obligatorio.",
            mensaje: "Campo obligatorio."
        }
    });
    if (1 == a.valid()) {
        var b = a.serialize();
        $.ajax({
            type: "POST",
            url: "sau-admin/admin.process.php",
            data: "process=11&" + b,
            beforeSend: function() {
                a.hide();
                a.parent().append('<div id="loadermydatos" class="loader-inner ball-pulse"><div></div><div></div><div></div></div>')
            },
            success: function(b) {
                a[0].reset();
                $("#loadermydatos").remove();
                a.show()
            },
            error: function() {}
        })
    }
});
$(".enviarmensajeaunusuario").on("click", function() {
    jQuery.validator.setDefaults({
        debug: !0,
        success: "valid",
        ignore: []
    });
    var a = $("#messagesfrmone");
    a.validate({
        rules: {
            asunto: "required",
            mensaje: "required"
        },
        messages: {
            asunto: "Campo obligatorio.",
            mensaje: "Campo obligatorio."
        }
    });
    if (1 == a.valid()) {
        var b = a.serialize();
        $.ajax({
            type: "POST",
            url: "sau-admin/admin.process.php",
            data: "process=12&" + b,
            beforeSend: function() {
                a.hide();
                a.parent().append('<div id="loadermydatos" class="loader-inner ball-pulse"><div></div><div></div><div></div></div>')
            },
            success: function(b) {
                a[0].reset();
                $("#loadermydatos").remove();
                a.show()
            },
            error: function() {}
        })
    }
});
$(".guardarconfiguracion").on("click", function() {
    jQuery.validator.setDefaults({
        debug: !0,
        success: "valid",
        ignore: []
    });
    var a = $("#configurationfrm");
    a.validate({
        rules: {
            messagemail: "required",
            messagechange: "required",
            renewmessage: "required",
            smtp: "required",
            port: "required",
            fromname: "required",
            mail: "required",
            password: "required",
            url: "required"
        }
    });
    if (1 == a.valid()) {
        var b = $("#configurationfrm").serialize();
        $.ajax({
            type: "POST",
            url: "sau-admin/admin.process.php",
            data: "process=13&" + b,
            beforeSend: function() {
                a.hide()
            },
            success: function(b) {
                a.show();
                $("#newModalPay").modal("toggle")
            },
            error: function() {}
        })
    }
});

$('.vercomentarios').on('click',function(){
    var a = $(this).attr('data-id')

    $.ajax({
        type:'POST'
      , url:'sau-admin/admin.process.php'
      , data:'process=14&publicacion='+a
      , beforeSend:function(){
            $('#data-append').html(' ');
            $('#trpublicacion'+a).addClass('opacityimgload');
        }
      , success:function(b){
            $('#data-append').append(b);
            $('#trpublicacion'+a).removeClass('opacityimgload');
            $('#myModal').modal('show');
            $('.deletecomment').on('click',function(){
                var a=$(this).attr('data-comment')
                  , b=$('#time-comment-'+a)
                  , yes=confirm('Esta seguro que desea eliminar el elemento?')

                if(yes){
                    $(this).addClass('animated zoomOut');
                    $.ajax({
                        type:'POST'
                      , url:'sau-admin/admin.process.php'
                      , data:'process=15&delete='+a
                      , beforeSend:function(){
                            b.prepend('<div id="loaders"><div class="loader-inner line-scale-pulse-out-rapid"><div></div><div></div><div></div><div></div><div></div></div></div>');
                        }
                      , success:function(){
                            b.addClass('animated bounceOut').fadeOut(1E3);
                            setTimeout(function(){
                                b.remove()
                            },2E3);
                        }
                      , error:function(){}
                    });
                }
            })
        }
      , error:function(){}
    })
});

$(".deleteusuariosnoactivos").on("click", function() {
    var a = $(this);
    $.ajax({
        type: "POST",
        url: "sau-admin/admin.process.php",
        data: "process=17",
        beforeSend: function() {
            a.prop("disabled", !0);
            a.append(' <i id="cogcarga" class="fa fa-clock-o fa-spin animated infinite flash pull-right"></i>')
        },
        success: function() {
            $("#cogcarga").remove();
            a.prop("disabled", !1)
        },
        error: function() {}
    })
});
