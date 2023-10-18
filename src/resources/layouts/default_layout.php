<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customers</title>
    <!-- <base href="."> -->
</head>
<style>
    <?php include __DIR__ . '/../css/layout_styles/default_layout_style.css'?>
</style>
<body>
<?php include __DIR__ . '/../headers/default_header.php';?>
<div class="default_layout">

    <main>
        <?= $content ?>
    </main>
    
    <?php $alert = Core\SessionManager::get('alert');
        if ($alert !== false && isset($alert['message']))
        {
            $message = $alert['message'];
            echo "<script>alert('$message')</script>";
            Core\SessionManager::pull('alert');
        }
        ?>
        
    </div>
<?php include __DIR__ . '/../footers/default_footer.php';?>
</body>
</html>