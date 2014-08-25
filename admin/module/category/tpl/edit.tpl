<Form action="{location}" method="POST" enctype="multipart/form-data" id="form">
    <div id="bg-content">
        <div><h1>{title}</h1></div>
        
        <div id="maincont">
            {content-page}
        </div>
        
        {control-content}
        
        <div class="button">
           <div class="row"><input type="submit" name="savePage" value="Сохранить страницу"></div>
        </div>    
    </div>    
</Form>