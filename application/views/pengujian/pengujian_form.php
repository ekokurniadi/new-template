
<div class="main-container" style="min-height:100%">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Pengujian</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengujian</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Form Pengujian </h4>
                        <p class="mb-30"></p>
                    </div>
                </div>
                <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	   
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Teks <?php echo form_error('teks') ?></label>
                          <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="teks" id="teks" placeholder="Teks" value="<?php echo $teks; ?>" />
                          </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Cleaning <?php echo form_error('cleaning') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" name="cleaning" id="cleaning" placeholder="Cleaning"><?php echo $cleaning; ?></textarea>
                        </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Casefolding <?php echo form_error('casefolding') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" name="casefolding" id="casefolding" placeholder="Casefolding"><?php echo $casefolding; ?></textarea>
                        </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tokenizing <?php echo form_error('tokenizing') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" name="tokenizing" id="tokenizing" placeholder="Tokenizing"><?php echo $tokenizing; ?></textarea>
                        </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Stemming <?php echo form_error('stemming') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" name="stemming" id="stemming" placeholder="Stemming"><?php echo $stemming; ?></textarea>
                        </div>
                    </div>
	 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Rekomendasi <?php echo form_error('rekomendasi') ?></label>
                        <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3" name="rekomendasi" id="rekomendasi" placeholder="Rekomendasi"><?php echo $rekomendasi; ?></textarea>
                        </div>
                    </div>
	
            
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengujian') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
          </form>
          </div>
      </div>
  </div>
</div>
