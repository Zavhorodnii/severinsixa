
<form role="search" method="get" class="header__search" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <!--    <label class="screen-reader-text" for="s">Поиск: </label>-->
    <input class="header__search-field" placeholder="Suche nach Produkten, Kategorien und mehr..." type="text" value="<?php echo get_search_query() ?>" name="s" id="s" />
    <button type="submit" class="header__search-btn" id="searchsubmit" value="найти" > </button>
</form>
