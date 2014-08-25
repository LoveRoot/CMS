<h2>Панель управления сайтом</h2>
<div class="section">
    <div class="form_row">
        <div class="row">
            <div class="checkbox">
                <input id="ADMIN_IP_ADDR_ENABLE" type="checkbox" name="ADMIN_IP_ADDR_ENABLE" action="{defend-ip}" />
                <label for="ADMIN_IP_ADDR_ENABLE">Активировать защиту по IP.</label>
            </div>  
        </div>
    </div>

    <div class="form_row">
        <div class="label">Привязка по IP</div>
        <div class="row"><input type="text" name="ADMIN_IP_ADDR" value="127.0.0.1" action="{attach-ip}" style="width:160px;"></div>	
    </div>
</div>
    
<h2>Регистрация на сайте</h2>

<div class="section">               
    <div class="form_row">
        <div class="row">
            <div class="checkbox">
                <input id="register_active" type="checkbox" name="register_active" action="{register_active}" />
                <label for="register_active">Регистрация на сайте.</label>
            </div>  
        </div>	
    </div>
                
    <div class="form_row">
        <div class="row">
            <div class="checkbox">
                <input id="confirm_register" type="checkbox" name="confirm_register" action="{confirm-regs}" />
                <label for="confirm_register">Отправлять на почту письмо с подтверждением на регистрацию .</label>
            </div>  
        </div>	
    </div>
</div>
