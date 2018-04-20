<style>
  .wpvc-view-count-table {
    width: 100%;
    border-collapse: collapse;
  }

  .wpvc-view-count-table tr {
    width: 100%;
  }

  .wpvc-view-count-table th {
    font-size: 1.25em;
    padding: 5px;
  }

  .wpvc-view-count-table td {
    border: 1px solid black;
    padding: 3px 5px;
  }

  .wpvc-views-col {
    text-align: center;
    width: 35%;
  }
</style>

<table class="wpvc-view-count-table">
<thead>
<tr>
<th>Page</th>
<th>Views</th>
</tr>
</thead>
<tbody>
<?php
  foreach(wpvc_get_all_num_views() as $view_count) {
    echo "<tr>
      <td>$view_count->post_title</td>
      <td class=\"wpvc-views-col\">$view_count->wpvc_num_views</td>
    </tr>";
  }
?>
</tbody>
</table>