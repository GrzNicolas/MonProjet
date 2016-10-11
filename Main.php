<?php

include("Header.php");

?>

    <section>

            <ul>
                <?php

                    if(isset($_GET["CAT"]) == true)
                {

                    $query = "SELECT DISTINCT article.ArticleTitle,article.ArticleContent,article.ArticleDate,article.ArticleTime,article.Idarticle, user.Username FROM article,user,category where user.Iduser=article.Iduser and article.ArticleFlag=1 and article.CategoryId=".$_GET["CAT"];
                   
                }
                else
                {
                    $query = "SELECT DISTINCT article.ArticleTitle,article.ArticleContent,article.ArticleDate,article.ArticleTime,article.Idarticle, user.Username FROM article,user,category where user.Iduser=article.Iduser and article.ArticleFlag=1";
                }

                    $result = Select($query);

                    foreach ($result as $Id) {

                        $ArticleID = $Id['Idarticle'];
                        $title = $Id['ArticleTitle'];
                        $content = $Id['ArticleContent'];
                        $name = $Id['Username'];
                        $date = $Id['ArticleDate'];
                        $d = substr($date, 8, 2) . "-" . substr($date, 5, 2) . "-" . substr($date, 0, 4);
                        $time = $Id['ArticleTime'];
                        $t = substr($time, 0, 2) . ":" . substr($time, 3, 2);
                        $reqnbcom = "SELECT count(*) as nbcom FROM comments where comments.Idarticle=" . $ArticleID;
                        $nbcom = Select($reqnbcom);
                        foreach ($nbcom as $nbc)
                                    $rest = substr($content,0,25);
                            echo(

                                '<li>
												<article>
												
												
												<div>
														<h2> <b>' . $title . '</b> </h2>
														<p>' . $rest . '...</p> 
														Post&eacute; ' . dateDisplay($d) . ' a ' . $t . ' par ' . $name . '.
												</div>
												<ul>
												' . $nbc['nbcom'] . ' <i class="fa fa-comment" aria-hidden="true"></i>
												
												<a href= Article.php?ID=' . $ArticleID . '>' . $title . '<i class="fa fa-plus-circle" aria-hidden="true"></i></a>

												</ul>
												</article>
									</li>');
                    }

                ?>
            </ul>


    </section>

<?php

function dateDisplay($date)
{

    switch ($date) {

        case $date == date("d-m-Y"):
            $date = "Aujourd'hui";
            break;

        case $date == date("d-m-Y") - 1:
            $date = "Hier";
            break;

        case $date < date("d-m-Y"):
            $date = "le " . $date;
            break;

    }
    return $date;
}

?>


<?php
include("Footer.php");

?>