<section class="content table-responsive">
        <table width="100%" id="data-table" class="table table-striped table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Created Users</th>
            <th>User</th>
            <th>Status</th>
            <th>Completion Type</th>
            <th>Developer</th>
            <th>Number of rooms</th>
            <th>Size of property</th>
            <th>Payment</th>
            <th>Down payment range</th>
            <th>Monthly installment range</th>
            <th>Payment duration range</th>
            <th>Delivery date</th>
            <th>Image</th>
            <th>Additional Property Description</th>
            <th>Commented at</th>
        </tr>
        </thead>
        <tbody>
            @include('Admin::posts.components.comments.table_body')
        </tbody>
    </table>
</section>