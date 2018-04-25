<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('/layout/common/header');?>

<body class="bg-img-num1">
    <div class="container">
    <?php $this->load->view('/layout/common/nav-top');?>
    </div>
    <?php $this->load->view($content); ?>
    <?php $this->load->view('/layout/javascript');?>
</body>

</html>