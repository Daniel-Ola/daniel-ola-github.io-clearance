<div id='appendmore' class='appendmore' style='display: none;'>
                                                            <hr style='border: 1px solid grey ;opacity: 0.5 ;' class='divhr'><span class='badge divspan'></span>
                                                            <div class='form-group img_doc'>
                                                                <label class='col-md-3 control-label' for='document<?php echo $count ?>'>Upload documents</label>
                                                                <div class='col-md-9'>
                                                                    <input type='file' name='document' id='document<?php echo $count ?>' class='form-control'>
                                                                </div>
                                                            </div>
                                                            <div class='form-group info_doc'>
                                                                <label class='col-md-3 control-label' for='addinfo<?php echo $count ?>'>Additional Info</label>
                                                                <div class='col-md-9'>
                                                                    <textarea name='addinfo' id='addinfo<?php echo $count ?>' class='form-control'><?php echo $clearance_status['addinfo'] ?></textarea>
                                                                    <!-- <input type='text' class='control' value='' style='display: none;'> -->
                                                                </div>
                                                            </div>
                                                            <div class='form-group del_doc'>
                                                                <div class='col-md-9 pull-right'>
                                                                    <button type='button' class='btn btn-xs btn-danger pull-right' onclick='deldoc()'><i class='fa fa-remove'></i> Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>