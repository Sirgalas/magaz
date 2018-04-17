<?php 
use frontend\widget\description\Description;
use sirgalas\menu\MenuView;
use frontend\widget\social\Social;
use frontend\widget\siteimage\Siteimage;
use frontend\widget\menu\Menu;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-20 col-md-24">
            <div class="col-lg-20 col-md-20 col-sm-24">
                <div class="col-lg-12 col-md-6 col-sm-24 description" >
                    <h2>О нас</h2>
                    <p><?= Description::widget([]); ?></p>
                    <a href="#" class="opentext"><?= Yii::t('frontend','OPENTEXT') ?></a>
                    <a href="#" class="closetext"><?= Yii::t('frontend','CLOSETEXT') ?></a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-24" >
                    <?php /* MenuView::widget([
                        'name'              =>  'Футер лево',
                        'nameAlias'         =>  'slug',
                        'menu'              =>['linkTemplate' => '<a href="{url}"><span class="fa fa-angle-right"></span>{label}</a>','options'=>['class' => false]]
                    ]);*/
                 ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-24" >
                    <?php /*= MenuView::widget([
                        'name'              =>  'Футер право',
                        'nameAlias'         =>  'slug',
                        'menu'              =>['linkTemplate' => '<a href="{url}"><span class="fa fa-angle-right"></span>{label}</a>',options=>['class' => false,]]
                    ]);*/
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-24 social">
                <?= Social::widget() ?>
            </div>
            <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 footerlogo">
                <a href="#" class="col-lg-11 col-md-11 col-sm-24 col-xs-24 copyrigth">
                    <span class="fa fa-copyright"></span>Милый дом</a>
                <?= Siteimage::widget(['name'=>'logo']); ?>
            </div>
        </div>
        <div class="col-lg-offset-2 col-lg-24 col-md-24">
            <?php if(isset($this->params['footer'])){ ?>
                <!-- MyCounter v.2.0 -->
                <script type="text/javascript"><!--
                    my_id = 149269;
                    my_width = 88;
                    my_height = 31;
                    my_alt = "MyCounter - счётчик и статистика";
                    //--></script>
                <script type="text/javascript"
                        src="https://get.mycounter.ua/counter2.0.js">
                </script><noscript>
                    <a target="_blank" href="http://mycounter.ua/"><img
                            src="https://get.mycounter.ua/counter.php?id=149269&quot;
    title="MyCounter - счётчик и статистика"
                        alt="MyCounter - счётчик и статистика"
                        width="88" height="31" border="0" /></a></noscript>
                <!--/ MyCounter -->
                <!--Textiletop counter--><script type="text/javascript"><!--
                    js=1;
                    document.write('<a href="http://textiletop.ru/zayabelka.html"'+
                        'target=_blank><img src="http://counter.textiletop.ru/hit/1979;r='+
                        escape(document.referrer)+';s='+((typeof(screen)=='undefined')?'':
                        +screen.width+'*'+screen.height+'*'+(screen.colorDepth?screen.colorDepth:screen.pixelDepth))+
                        ';u='+escape(document.URL)+';j='+navigator.javaEnabled()+
                        ';rand='+Math.random()+';cookie='+navigator.cookieEnabled+'" alt="" '+
                        'title="Текстильная промышленность Постельное белье Пледы" '+
                        'border=0 width=88 height=31></a>')
                    if(js=1)document.write('<'+'!-- ')//--></script><noscript><a href="http://textiletop.ru/zayabelka.html&quot;
 target=_blank><img src="http://counter.textiletop.ru/hit/1979;js=na&quot; alt="" title="Текстильная промышленность Постельное белье Пледы"
                    border=0 width=88 height=31></a></noscript><script type="text/javascript"><!--
                    if(js=1)document.write('--'+'>')//--></script>
                <!--/Textiletop-->
            <?php } ?>
            <!-- HotLog -->
            <span id="hotlog_counter"></span>
            <span id="hotlog_dyn"></span>
            <script type="text/javascript"> var hot_s = document.createElement('script');
                hot_s.type = 'text/javascript'; hot_s.async = true;
                hot_s.src = 'http://js.hotlog.ru/dcounter/2496283.js';
                hot_d = document.getElementById('hotlog_dyn');
                hot_d.appendChild(hot_s);
            </script>
            <noscript>
                <a href="http://click.hotlog.ru/?2496283&quot; target="_blank">
                <img src="http://hit34.hotlog.ru/cgi-bin/hotlog/count?s=2496283&im=307&quot; border="0"
                title="HotLog" alt="HotLog"></a>
            </noscript>
            <!-- /HotLog -->
            <a href='http://www.irdir.info/' title='Посетите интеллектуальный каталог ресурсов интернет'><img border='0' alt='Интеллектуальный каталог ресурсов интернет' src='http://static.irdir.info/img/banners/8831-1.gif' width='88' height='31' /></a>       <a href="http://webplus.info/index.php?page=47&add_top_url=141287"><img alt="Каталог webplus.info" border=0 src="http://webplus.info/getres.php?infoforurl=141287&color=gray"></a>
            </center>
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function() {
                        try {
                            w.yaCounter34542275 = new Ya.Metrika({
                                id:34542275,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true
                            });
                        } catch(e) { }
                    });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () { n.parentNode.insertBefore(s, n); };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/watch.js&quot;;

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else { f(); }
                })(document, window, "yandex_metrika_callbacks");
            </script>
            <!--LiveInternet counter--><script type="text/javascript"><!--
                document.write("<a href='//www.liveinternet.ru/click' "+
                    "target=_blank><img src='//counter.yadro.ru/hit?t38.2;r"+
                    escape(document.referrer)+((typeof(screen)=="undefined")?"":
                    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                    ";"+Math.random()+
                    "' alt='' title='LiveInternet' "+
                    "border='0' width='31' height='31'><\/a>")
                //--></script><!--/LiveInternet-->
            <noscript><div><img src="https://mc.yandex.ru/watch/34542275&quot; style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter34542275 = new Ya.Metrika({ id:34542275, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/34542275" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

        </div>
    </div>
</div>