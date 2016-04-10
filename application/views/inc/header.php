<?php
if (!isset($title)) {
    $title = "IBTD Music - Músicas do Louvor";
}
else
{
    $title = "IBTD Music - Músicas do Louvor - ".$title;
}
?>

<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $title; ?></a>
            </div>
            <!-- /.navbar-header -->

            <!-- /.dropdown-tasks -->                
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li>
                            <a href="<?php echo base_url('index.php/pessoas'); ?>"><i class="fa fa-group fa-fw"></i> Pessoas</a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url('index.php/grupos'); ?>"><i class="fa fa-sitemap fa-fw"></i> Grupos</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/musicas'); ?>"><i class="fa fa-table fa-fw"></i> Músicas</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>