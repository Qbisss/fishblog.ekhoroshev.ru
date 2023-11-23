$('form[id^="likeForm"]').on('submit', function(event){
           
            event.preventDefault();      
            var url = $(this).attr('data-action');
            var id = this.id.replace(/likeForm/, '');
            var amount = $('#amount'+id).html();

            $.ajax({
                url: url,
                method:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                   id:id,
                   amount:amount
                },
                success:function(response){
                    console.log(response);
                    $('#amount' + id).text(response.likes)
                    $('#submitlike' + id).removeClass();
                    $('#submitlike' + id).addClass(response.class);
                },
             });
        });