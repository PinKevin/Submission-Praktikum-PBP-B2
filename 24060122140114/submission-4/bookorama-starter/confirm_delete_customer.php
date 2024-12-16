<?php include('./header.php') ?>
<?php
session_start();
require_once('./db_login.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header('Location: view_customer.php');
    exit;
}
?>

<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this customer?
            </div>
            <div class="modal-footer">
                <a href="delete_customer.php?id=<?php echo $id; ?>" class="btn btn-danger">Yes, delete</a>
                <a href="view_customer.php" class="btn btn-secondary ">Cancel</a>
            </div>
        </div>
    </div>
</div>

<!-- Trigger Modal -->
<script>
$(document).ready(function() {
    $('#deleteModal').modal('show');
});
</script>

<?php include('./footer.php') ?>