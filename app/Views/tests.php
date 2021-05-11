
<div id="content" class="flex-column body-fill p-15">
    <? if ($test){
        echo "<p>".$test['question']."</p>";
        echo "<small>".(($test['count_answers']==true)?lang('test.alot_answer'):lang('test.one_answer'))."</small>";
        echo "<div id='answers' class='p-15 flex-column' style='width:fit-content; align-items:flex-start'>";
        $answers=json_decode($test['answer']);
        for($i=0;$i<count($answers);$i++){

            echo "<div class='p-15'>".($i+1)."<input type='radio' ".(($test['count_answers']==false)?"name='radio'":"")." class='p-15'/>".$answers[$i]."</div>";
        }
        echo "</div>";
        echo "<div id='bSubmit' class='button opacity-hover cursor-pointer' onClick='sendAnswer()' >".lang('test.submit')."</div>";
        echo "<div id='bNext' class='button opacity-hover cursor-pointer' style='display:none' onClick='location.href=\"".base_url()."/user\"' >".lang('test.next')."</div>";
        echo "<div id='message' class='p-15'></div>";
    }
    else echo "<a href='".base_url()."' >".lang("test.no_test")."</a>";
    ?>
    <div>
        
    </div>
</div>

<script>
    function setMessage(text, type){
        document.getElementById('message').innerHTML="<p class='"+type+"'>"+text[current_lang]+"</p>";
    }
    function sendAnswer(){
        let choosenAnswers=document.querySelectorAll('input[type="radio"]');
        var answer='';
        for(let i=0;i<choosenAnswers.length;i++){
            console.log(choosenAnswers[i]);
            if(choosenAnswers[i].checked){
                if(answer.length>0){
                    answer+=',';
                }
                answer+=i;
            }  
           
        }
        if(answer==''){
                setMessage({
                    en:'Choose something',
                    ru:'Выбери что-нибудь'
                },'alert-text');
            }
            else{
                fetch(base_url+'/setAnswer',{
                method:'POST',
                mode:'no-cors',
                headers:{
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body:'answer='+answer
            }).then((response)=>{
                if(response.status!=200){
                    throw new Error('Can`t get data ');
                }
                response.json().then((data)=>{
                    if(data['success']){
                            setMessage({
                            en:' Well done!',
                            ru:'Молодец, ты справился!'
                        },'success-text');

                        
                    }else{
                        var map = Array.prototype.map;
                        var ua = map.call(data['user_answer'].split(','),function(x){
                            console.log(x);
                            if(x!=','){
                                return (parseInt(x)+1);
                            }

                        });
                        var ca = map.call(data['correct_answer'].split(','),function(x){
                            if(x!=','){
                                return (parseInt(x)+1);
                            }
 
                        });
                        console.log(ca, ua);
                        setMessage({
                            en:'Your answer:'+ua+'  Correct answer:'+ca,
                            ru:'Твои ответы:'+ua+'  Правильные ответы:'+ca,
                        },'alert-text');
                    }
                    document.getElementById('bNext').style.display="block";
                    document.getElementById('bSubmit').style.display="none";
                });

            })
            .catch((error)=>{
                console.error('error:',error);
            });
            }
    }
</script>