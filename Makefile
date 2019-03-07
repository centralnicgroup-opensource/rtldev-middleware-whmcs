ISPAPI_REGISTRAR_MODULE_VERSION := $(shell php -r 'include "registrars/ispapi/ispapi.php"; print $$ispapi_module_version;')
FOLDER := pkg/whmcs-ispapi-registrar-$(ISPAPI_REGISTRAR_MODULE_VERSION)

clean:
	rm -rf $(FOLDER)

buildsources:
	mkdir -p $(FOLDER)/install/modules/registrars
	mkdir -p $(FOLDER)/install/modules/widgets
	cp -a registrars/ispapi $(FOLDER)/install/modules/registrars
	cp widgets/hexonet_summary.php $(FOLDER)/install/modules/widgets
	mv $(FOLDER)/install/modules/registrars/ispapi/README.pdf $(FOLDER)
	cp README.md HISTORY.md HISTORY.old CONTRIBUTING.md LICENSE $(FOLDER)
	find $(FOLDER)/install -name "*~" | xargs rm -f
	find $(FOLDER)/install -name "*.bak" | xargs rm -f
	rm -f $(FOLDER)/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt

buildlatestzip:
	cp pkg/whmcs-ispapi-registrar.zip ./whmcs-ispapi-registrar-latest.zip # for downloadable "latest" zip by url

zip:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION);
	rm -rf pkg/whmcs-ispapi-registrar.zip
	@$(MAKE) buildsources
	cd pkg && zip -r whmcs-ispapi-registrar.zip whmcs-ispapi-registrar-$(ISPAPI_REGISTRAR_MODULE_VERSION)
	@$(MAKE) clean

tar:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)
	rm -rf pkg/whmcs-ispapi-registrar.tar.gz
	@$(MAKE) buildsources
	cd pkg && tar -zcvf whmcs-ispapi-registrar.tar.gz whmcs-ispapi-registrar-$(ISPAPI_REGISTRAR_MODULE_VERSION)
	@$(MAKE) clean

allarchives:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)
	rm -rf pkg/whmcs-ispapi-registrar.zip
	rm -rf pkg/whmcs-ispapi-registrar.tar
	@$(MAKE) buildsources
	cd pkg && zip -r whmcs-ispapi-registrar.zip whmcs-ispapi-registrar-$(ISPAPI_REGISTRAR_MODULE_VERSION) && tar -zcvf whmcs-ispapi-registrar.tar.gz whmcs-ispapi-registrar-$(ISPAPI_REGISTRAR_MODULE_VERSION)
	@$(MAKE) buildlatestzip
	@$(MAKE) clean
