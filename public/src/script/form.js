
var formBuilder={
    wrapObj:null,
    setFormWrapF:function(table,fieldsF,fieldsA,footer_buttons,action,style_class=''){
        this.setWrap();
        this.setModalPanel(action,style_class);
        this.setModalBodyF(fieldsF,fieldsA);
        this.setModalLinkButtons(table,footer_buttons);
        this.setError();
    },
    setWrap:function(){
        this.wrapObj=document.getElementById('modal_wrap');        
        if(!this.wrapObj){
            document.body.insertAdjacentHTML('beforeend',"<div id='modal_wrap' class='wrap' style='display:flex'><\/div>");
            this.wrapObj=document.getElementById('modal_wrap');   
        }
        else{
            this.wrapObj.style.display="flex";
        }
    //     <div id="modal_wrap" class="wrap">
	// 	<div id="admin_form" class="panel dark modal-wrap p-15" table="users">
	// 		<div class='form_body'>
	// 		</div>
	// 		<div id="button_check_admin" class="button cursor-pointer opacity-hover" onClick="checkAdmin()">
	// 		<? echo lang('home.form_check_admin_button'); ?>
	// 		</div>
	// // 	</div>
	// </div>
    },
    setModalPanel:function(action,style_class=''){
        this.wrapObj.innerHTML='';
        this.wrapObj.insertAdjacentHTML('afterbegin',"<form method='post' action='"+action+"' id='modal_panel' class='panel modal-wrap p-15 "+style_class+"'><\/form>");
    },
    setModalBodyF:function(fields,arrayFields){
        document.querySelector('form').insertAdjacentHTML('afterbegin',"<div id='modal_body' class='flex-column p-15'><\/div>");
        let fb=document.getElementById('modal_body');
        arrayFields.forEach(key => {
            fb.insertAdjacentHTML('beforeend',this.getFieldInput(fields[key],key));
        });
        // for(let key in fields){
        //     fb.insertAdjacentHTML('afterbegin',this.getFieldInput(fields[key],key));
        // }
    },
    getFieldInput:function(field,key){
        console.log(field);
        let placeholder=(field['title'])?field['title'][current_lang]:'';
        
        return "<input id='input"+key+"'name='"+key+"' type='"+field['type']+"' placeholder='"+placeholder+"' class='input-"+field['type']+"' />";
    },
    getLinkButton:function(table,button){
        return 	"<button id='b"+button.type+"' class='button cursor-pointer opacity-hover' type='"+button.button_type+"'>"+button['title'][current_lang]+"  </button>";
    },
    setError:function(){
        document.querySelector('form').insertAdjacentHTML('beforeend',"<div id='error_message' ><\/div>");
    },
    setClickButtonEvent:function(table,button){
        let bType=button.type;
        let but=document.getElementById('b'+button.type);
        let inst=this;
        switch(bType){
            case 'close-wrap':
                default:
                    but.onclick=function(){
                        inst.deleteFormWrap();
                        console.log(form.forms[table]);
                    };
                    break;
            case 'check':
                but.onclick=function(){
                    console.log(form.forms[table]);
                };
                break;
            case 'save':
                break;

        }

        
    },
    setModalLinkButtons:function(table,footer_buttons){
        let inst=this;
        document.getElementById('modal_panel').insertAdjacentHTML('beforeend',"<div id='modal_footer' class='flex-row'><\/div>");
        let fb=document.getElementById('modal_footer');
        footer_buttons.forEach(element => {
            fb.insertAdjacentHTML('afterbegin',this.getLinkButton(table,element));
            inst.setClickButtonEvent(table,element);
        });
        // for(let key in link_buttons){
        //     fb.insertAdjacentHTML('afterbegin',this.getLinkButton(link_buttons[key],key));
        //     //document.getElementById('b'+key).onClick=link_buttons[key].onClickB();
        // }
    },
    deleteFormWrap:function(){
        document.getElementById('modal_wrap').innerHTML='';
        document.getElementById('modal_wrap').style.display="none";
    }
};

var form={
    forms:{},
    init:async function(){
        let formsTab=document.querySelectorAll('[table]');
        let queryTables='';
        let body=new FormData();
        if(formsTab){
            for(let i=0;i<formsTab.length;i++){
                console.log(formsTab[i].getAttribute('table'));
                if(queryTables.length>0){
                    queryTables+=',';
                }
                queryTables+='\''+formsTab[i].getAttribute('table')+'\'';
            }
            console.log(queryTables);
            fetch(base_url+'/getForm',{
                method:'POST',
                mode:'no-cors',
                headers:{
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body:'tables='+queryTables
            }).then((response)=>{
                if(response.status!=200){
                    throw new Error('Can`t get data ');
                }
                response.json().then((data)=>{
                    for(let key in data){
                        this.forms[key]=JSON.parse(data[key]);
                    }
                    server_message_obj.init();
                });

            })
            .catch((error)=>{
                console.error('error:',error);
            });
        }
        
    },
    cc:function(text){
        console.log(text);
    },
    setFormWrapF:function(tableName,fieldsA,footer_buttons,action,style_class=''){
        console.log(this);
        // fieldsF,fieldsA,footer_buttons,style_class=''
        formBuilder.setFormWrapF(tableName,this.forms[tableName].fields,fieldsA,footer_buttons,action,style_class);
    },
    deleteForm:function(){
        formBuilder.deleteFormWrap();
    },
    setValidateErrorFormWrapF:function(tableName,errorsValidate, inputdata, main_message=''){
        let error_message='';
        for(let key in errorsValidate){
            let el=document.getElementById('input'+key);
            if(el)
            {
                error_message+=this.forms[tableName]['fields'][key]['validate']['errors'][current_lang][errorsValidate[key]]+" ";
                el.classList.add('alert');
            }

            
        }
        for(let key in inputdata){
            let el=document.getElementById('input'+key);
            if(el)
            {
                el.setAttribute('value',inputdata[key]);
            }
        }
        document.getElementById('error_message').innerHTML=error_message+main_message;
        console.log('err',error_message);
    }
}

form.init();