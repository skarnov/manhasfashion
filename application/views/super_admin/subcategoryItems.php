<?php foreach ($all_subcategory_items as $category): ?>    
    <option value="<?php echo $category->pk_category_id; ?>"><?php echo $category->category_name; ?></option>
<?php endforeach; ?>