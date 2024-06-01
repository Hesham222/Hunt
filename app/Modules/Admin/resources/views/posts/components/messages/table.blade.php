<section class="content table-responsive">
        <table width="100%" id="data-table" class="table table-striped table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Sender</th>
            <th>User</th>
            <th>Title</th>
            <th>Message</th>
            <th>Commented at</th>
        </tr>
        </thead>
        <tbody>
            @include('Admin::posts.components.messages.table_body')
        </tbody>
    </table>
</section>
