<?php 
/**
 * Usage:
 * 
 * This elements takes following variables:
 * 
 * - 'paginationCounter' Array with options for PaginatorHelper::counter()
 * - 'paginationNumbers' Array with options for PaginatorHelper::numbers()
 * 
 */
//TODO move css to css file
?>
<style>
.pagination-wrap {
    margin: 10px 0 0;
    overflow: hidden;
}

.pagination-wrap .pagination-counter {
    float: left;
    margin: 0;
    text-align: left;	
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    display: inline-block;
    margin-bottom: 0;
    margin-left: 0;
    background-color: #FFFFFF;
    border-color: #DDDDDD;
    border-image: none;
    border-style: solid;
    border-width: 1px 1px 1px 1px;
    float: left;
    line-height: 20px;
    padding: 4px 12px;
    text-decoration: none;
}

.pagination-wrap .pagination {
    float: right;
    margin: 0;
    text-align: left;	
}

</style>
<?php
	//counter
	if (!isset($paginationCounter)) $paginationCounter = array();
	$paginationCounter = am(array(
		//'format' => __d('admin_panel','Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		'format' => __d('backend','Page {:page} of {:pages}, showing {:current} records out of {:count} total')
	),$paginationCounter);
	//numbers
	if (!isset($paginationNumbers)) $paginationNumbers = array();
	$paginationNumbers = am(array(
		'separator' => '',
		'tag' => 'li',
		'first' => 'first',
		'last' => 'last',
		'modulus' => 8,
		'ellipsis' => '...',
		'currentClass' => 'active', //requires CakePHP 2.1
		'currentTag' => 'span' //requires CakePHP 2.3
	),$paginationNumbers);
?>
<div class="pagination-wrap">
	<div class="pagination-counter"><?php
	echo $this->Paginator->counter($paginationCounter);
	?></div>
	
	<div class="pagination">
		<ul>
			<li><?php echo $this->Paginator->prev('< ' . __d('backend','previous'), array(), null, array('class' => 'prev')); ?></li>
			<?php echo $this->Paginator->numbers($paginationNumbers); ?>
			<li><?php echo $this->Paginator->next(__d('backend','next') . ' >', array(), null, array('class' => 'next')); ?></li>
		</ul>
	</div>
</div>