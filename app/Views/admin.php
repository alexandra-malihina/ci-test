
<div id="content" class="flex-lg-row flex-sm-column body-fill p-15">

    <div id="tests" table="tests" class="block p-15 flex-column box-shadow" >
        <? echo lang('user.admin_test_block'); ?>

        <? 
                if($tests){
                    echo '<table>';
                    echo "<tr>";
                    echo "<th>".lang('user.admin_test_block_question')."</th>";
                    echo "<th>".lang('user.admin_test_block_answer')."</th>";
                    echo "<th>".lang('user.admin_test_block_best_answer')."</th>";
                    echo "</tr>";
                    for ($i=0;$i<count($tests);$i++){
                        $t=$tests[$i];
                        $question=$t['question'];
                        $answer=implode('<br>',json_decode($t['answer']));
                        $ba=$t['best_answer'];
                        echo '<tr>';
                        echo "<td>$question</td>";
                        echo "<td>$answer</td>";
                        echo "<td>$ba</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
    </div>
    <div id="users" table="users" class="block p-15 flex-column box-shadow" >
        <p><? echo lang('user.admin_user_block'); ?></p>
        <div class="flex-column">
            <div class="button cursor-pointer opacity-hover" id="adduser" onClick="formUser()">
				<? echo lang('user.admin_add_user_button'); ?>
			</div>
            <? 
                if($users){
                    echo '<table>';
                    echo "<tr>";
                    echo "<th>".lang('user.admin_user_block_login')."</th>";
                    echo "<th>".lang('user.admin_user_block_role')."</th>";
                    echo "</tr>";
                    for ($i=0;$i<count($users);$i++){
                        $u=$users[$i];
                        $login=$u['login'];
                        $role=$u['role'];
                        echo '<tr>';
                        echo "<td>$login</td>";
                        echo "<td>$role</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </div>
</div>
<script>
    function formUser(){
        form.setFormWrapF("users",['login','password'],[
				{
					type:'close-wrap',
					button_type:'reset',
					title:{
						en:'Close',
						ru:'Назад'
					}
				},
				{
					type:'save',
					button_type:'submit',
					title:{
						en:'Save',
						ru:'Добавить'
					}
				}
			],base_url+'/users/add');
		}
    
</script>