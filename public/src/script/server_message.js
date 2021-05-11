var server_message_obj={
    init:function(){
        if(server_message){
            if (server_message['error']){
                if(server_message['error']['form']){
                    document.getElementById(server_message['error']['form']['name_action']).onclick();
                    form.setValidateErrorFormWrapF(server_message['error']['form']['table'],server_message['error']['form']['validate'], server_message['error']['form']['data'],server_message['error']['form']['error_message'][current_lang]);
                }
            }
        }
    }
};

