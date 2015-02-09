<style type="text/css">.Mscroll{height: 100%;overflow: auto;}</style>
<script src="jquery.nicescroll.min.js"></script>
<script>  $(document).ready(function() {$(".Mscroll").niceScroll({cursorborder:"",cursorcolor:"rgb(162, 162, 184)",boxzoom:false});   });</script>
<div class="right-area -js-right-area Mscroll" style="display: block; overflow: hidden; padding: 0px;  outline: none;" tabindex="0">
                
            <div class="jspContainer" >
			
			<div class="jspPane" style="padding: 0px; top: 0px;"><div class="right-area-content -js-right-area-content">

<div class="profile row">
   
    <div class="col-md-2">    </div>
    <form class="mainInfo form-horizontal col-md-6" autocomplete="off">
        <h2>Настройки профиля</h2>
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Фамилия</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" maxlength="250" value="" name="User[last_name]">
                    <div class="error" id="error_last_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Имя</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" maxlength="250" value="Телематик" name="User[first_name]">
                    <div class="error" id="error_first_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Отчество</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" maxlength="250" value="" name="User[middle_name]">
                    <div class="error" id="error_middle_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Название компании</label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" class="form-control" maxlength="250" value="ООО &quot;НПО &quot;СтарЛайн&quot;" name="User[company_name]">
                    <div class="error" id="error_company_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Как к Вам обращаться?</label>
                <div class="col-sm-8">
                    <select class="form-control" name="User[sex]">
                        <option value="">не указано</option>
                        <option value="M" selected="">сударь</option>
                        <option value="F">сударыня</option>
                    </select>
                    <div class="error" id="error_sex"></div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Пароль</label>
                <div class="col-sm-8">
                    <input autocomplete="off" class="form-control" type="password" maxlength="250" name="User[pass]">
                    <div class="error" id="error_pass"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Подтверждение пароля</label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="password" class="form-control" maxlength="250" name="User[passRepeat]">
                    <div class="error" id="error_passRepeat"></div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Язык</label>
                <div class="col-sm-8">
                    <select name="User[lang]" class="form-control">
                        <option value="ru" selected="selected">Русский</option>
                        <option value="en">English</option>
                        <option value="it">Italiano</option>
                    </select>
                    <div class="error" id="error_lang"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Часовой пояс</label>
                <div class="col-sm-8">
                    <select name="User[gmt]" class="form-control">
                        <option value="-11"> -11 Ном (Аляска), Самоа
                        </option><option value="-10"> -10 Аляска, Гавайи
                        </option><option value="-9"> -9 Аляска
                        </option><option value="-8"> -8 Лос-Анджелес, Сан-Франциско, Сиэтл, Ванкувер
                        </option><option value="-7"> -7 Денвер, Феникс, о.Пасхи
                        </option><option value="-6"> -6 Даллас, Чикаго, Хьюстон
                        </option><option value="-5"> -5 Нью-Йорк, Вашингтон, Атланта, Оттава, Гавана, Богота, Лима
                        </option><option value="-4"> -4 Ла-Пас, Каракас, Галифакс
                        </option><option value="-3:30"> -3:30 Ньюфаундленд
                        </option><option value="-3"> -3 Буэнос-Айрес, Рио-де-Жанейро, Сан-Паулу
                        </option><option value="-2"> -2 Среднеатлантическое время, Антарктика
                        </option><option value="-1"> -1 Азорские о-ва
                        </option><option value="+0"> +0 Гринвич, Лондон, Рейкьявик, Лиссабон, Дакар
                        </option><option value="+1"> +1 Рим, Париж, Берлин, Осло, Мадрид, Копенгаген, Вена
                        </option><option value="+2"> +2 Киев, Минск, Анкара, Афины, Иерусалим, Хельсинки, София, Бухарест, Кейптаун
                        </option><option value="+3"> +3 Москва, Аддис-Абеба, Багдад
                        </option><option value="+3:30"> +3:30 Иран
                        </option><option value="+4" selected="selected"> +4 Тегеран, Баку, Абу-Даби
                        </option><option value="+4:30"> +4:30 Афганистан
                        </option><option value="+5"> +5 Тюмень, Душанбе, Ташкент, Карачи
                        </option><option value="+5:30"> +5:30 Индия, Шри-Ланка
                        </option><option value="+5:45"> +5:45 Непал
                        </option><option value="+6"> +6 Новосибирск, Алматы
                        </option><option value="+6:30"> +6:30 Мьянма
                        </option><option value="+7"> +7 Джакарта, Бангкок
                        </option><option value="+8"> +8 Иркутск, Пекин, Шанхай
                        </option><option value="+9"> +9 Токио, Сеул, Пхеньян
                        </option><option value="+9:30"> +9:30 Австралия (Аделаида, Дарвин)
                        </option><option value="+10"> +10 Владивосток, Хабаровск, Магадан, Южно-Сахалинск, Анадырь, Петропавловск-Камчатский
                    </option></select>
                    <div class="error" id="error_gmt"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-12">
                <input type="reset" class="btn btn-default" value="Сбросить">
                <input type="submit" class="btn btn-primary" value="Сохранить">
				<input type="submit" class="btn btn-danger" value="Удалить">
				
            </div>
        </div>
	
    </form>
    <div class="contactsContainer col-md-4">
       
    </div>
	
</div>



<div class="profile row">
   
    <div class="col-md-2">    </div>
    <form class="mainInfo form-horizontal col-md-6" autocomplete="off">
        <h2>Настройки профиля</h2>
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Фамилия</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" maxlength="250" value="" name="User[last_name]">
                    <div class="error" id="error_last_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Имя</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" maxlength="250" value="Телематик" name="User[first_name]">
                    <div class="error" id="error_first_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Отчество</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" maxlength="250" value="" name="User[middle_name]">
                    <div class="error" id="error_middle_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Название компании</label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" class="form-control" maxlength="250" value="ООО &quot;НПО &quot;СтарЛайн&quot;" name="User[company_name]">
                    <div class="error" id="error_company_name"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Как к Вам обращаться?</label>
                <div class="col-sm-8">
                    <select class="form-control" name="User[sex]">
                        <option value="">не указано</option>
                        <option value="M" selected="">сударь</option>
                        <option value="F">сударыня</option>
                    </select>
                    <div class="error" id="error_sex"></div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Пароль</label>
                <div class="col-sm-8">
                    <input autocomplete="off" class="form-control" type="password" maxlength="250" name="User[pass]">
                    <div class="error" id="error_pass"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Подтверждение пароля</label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="password" class="form-control" maxlength="250" name="User[passRepeat]">
                    <div class="error" id="error_passRepeat"></div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Язык</label>
                <div class="col-sm-8">
                    <select name="User[lang]" class="form-control">
                        <option value="ru" selected="selected">Русский</option>
                        <option value="en">English</option>
                        <option value="it">Italiano</option>
                    </select>
                    <div class="error" id="error_lang"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Часовой пояс</label>
                <div class="col-sm-8">
                    <select name="User[gmt]" class="form-control">
                        <option value="-11"> -11 Ном (Аляска), Самоа
                        </option><option value="-10"> -10 Аляска, Гавайи
                        </option><option value="-9"> -9 Аляска
                        </option><option value="-8"> -8 Лос-Анджелес, Сан-Франциско, Сиэтл, Ванкувер
                        </option><option value="-7"> -7 Денвер, Феникс, о.Пасхи
                        </option><option value="-6"> -6 Даллас, Чикаго, Хьюстон
                        </option><option value="-5"> -5 Нью-Йорк, Вашингтон, Атланта, Оттава, Гавана, Богота, Лима
                        </option><option value="-4"> -4 Ла-Пас, Каракас, Галифакс
                        </option><option value="-3:30"> -3:30 Ньюфаундленд
                        </option><option value="-3"> -3 Буэнос-Айрес, Рио-де-Жанейро, Сан-Паулу
                        </option><option value="-2"> -2 Среднеатлантическое время, Антарктика
                        </option><option value="-1"> -1 Азорские о-ва
                        </option><option value="+0"> +0 Гринвич, Лондон, Рейкьявик, Лиссабон, Дакар
                        </option><option value="+1"> +1 Рим, Париж, Берлин, Осло, Мадрид, Копенгаген, Вена
                        </option><option value="+2"> +2 Киев, Минск, Анкара, Афины, Иерусалим, Хельсинки, София, Бухарест, Кейптаун
                        </option><option value="+3"> +3 Москва, Аддис-Абеба, Багдад
                        </option><option value="+3:30"> +3:30 Иран
                        </option><option value="+4" selected="selected"> +4 Тегеран, Баку, Абу-Даби
                        </option><option value="+4:30"> +4:30 Афганистан
                        </option><option value="+5"> +5 Тюмень, Душанбе, Ташкент, Карачи
                        </option><option value="+5:30"> +5:30 Индия, Шри-Ланка
                        </option><option value="+5:45"> +5:45 Непал
                        </option><option value="+6"> +6 Новосибирск, Алматы
                        </option><option value="+6:30"> +6:30 Мьянма
                        </option><option value="+7"> +7 Джакарта, Бангкок
                        </option><option value="+8"> +8 Иркутск, Пекин, Шанхай
                        </option><option value="+9"> +9 Токио, Сеул, Пхеньян
                        </option><option value="+9:30"> +9:30 Австралия (Аделаида, Дарвин)
                        </option><option value="+10"> +10 Владивосток, Хабаровск, Магадан, Южно-Сахалинск, Анадырь, Петропавловск-Камчатский
                    </option></select>
                    <div class="error" id="error_gmt"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-12">
                <input type="reset" class="btn btn-default" value="Сбросить">
                <input type="submit" class="btn btn-primary" value="Сохранить">
				<input type="submit" class="btn btn-danger" value="Удалить">
				
            </div>
        </div>
	
    </form>
    <div class="contactsContainer col-md-4">
       
    </div>
	
</div>
</div>
</div>
<div class="jspVerticalBar">
<div class="jspCap jspCapTop"></div>
<div class="jspTrack" style="height: 567px;">
<div class="jspDrag" style="height: 484px;">
<div class="jspDragInside"></div>
<div class="jspDragTop"></div>
<div class="jspDragBottom"></div>
</div>
</div>
<div class="jspCap jspCapBottom"></div>
</div>
</div>
</div>