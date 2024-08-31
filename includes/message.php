<?php 

//For alert messages Comming under SESSION success 
if (isset($_SESSION['success']) && $_SESSION != '') {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['success']);
}

//For alert messages Comming under SESSION warning 
if (isset($_SESSION['warning']) && $_SESSION != '') {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> <?php echo $_SESSION['warning']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['warning']);
}

//For alert messages Comming under SESSION Danger 
if (isset($_SESSION['danger']) && $_SESSION != '') {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> <?php echo $_SESSION['danger']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['danger']);
}
?>