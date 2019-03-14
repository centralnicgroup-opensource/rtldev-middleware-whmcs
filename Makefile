VERSION := $(shell node -p "require('./release.json').version")
REPOID := whmcs-ispapi-registrar
FOLDER := pkg/$(REPOID)-$(VERSION)

clean:
	rm -rf $(FOLDER)

buildsources:
	# create archive folder structure
	mkdir -p $(FOLDER)/docs
	mkdir -p $(FOLDER)/install/modules/registrars
	mkdir -p $(FOLDER)/install/modules/widgets
	# clone repository wiki
	rm -rf /tmp/$(REPOID)
	git clone https://github.com/hexonet/$(REPOID).wiki.git /tmp/$(REPOID)
	# Copy files (archive contents)
	cp -a registrars/ispapi $(FOLDER)/install/modules/registrars
	cp widgets/hexonet_summary.php $(FOLDER)/install/modules/widgets
	cp README.md HISTORY.md HISTORY.old CONTRIBUTING.md LICENSE /tmp/$(REPOID)/*.md $(FOLDER)/docs
	# Clean up files
	rm -rf $(FOLDER)/docs/_*.md $(FOLDER)/docs/Home.md /tmp/$(REPOID)
	# convert all necessary files to html
	find $(FOLDER)/docs -maxdepth 1 -name "*.md" -exec bash -c 'pandoc "$${0}" -f markdown -t html -s --self-contained -o "$${0/\.md/}.html"' {} \;
	pandoc $(FOLDER)/docs/LICENSE -t html -s --self-contained -o $(FOLDER)/docs/LICENSE.html
	rm -rf $(FOLDER)/docs/*.md $(FOLDER)/docs/LICENSE
	# replacements in html files
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'sed -i -e "s/https:\/\/github\.com\/hexonet\/$(REPOID)\/wiki/\./g" "$${0}"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'sed -i -e "s/https:\/\/github\.com\/hexonet\/$(REPOID)\/blob\/master/\./g" "$${0}"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/Contact-Us.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/CONTRIBUTING.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/Development-Guide.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/HISTORY.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/LICENSE.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/README.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/Release-Notes.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(FOLDER)/docs/Usage-Guide.html"' {} \;
	find $(FOLDER)/docs -maxdepth 1 -name "*.html" -exec bash -c 'sed -i -e "s/\.html\.md/\.html/g" "$${0}"' {} \;
	find $(FOLDER)/install -name "*~" | xargs rm -f
	find $(FOLDER)/install -name "*.bak" | xargs rm -f

buildlatestzip:
	cp pkg/$(REPOID).zip ./$(REPOID)-latest.zip

zip:
	@echo $(VERSION);
	rm -rf pkg/$(REPOID).zip
	@$(MAKE) buildsources
	cd pkg && zip -r $(REPOID).zip $(REPOID)-$(VERSION)
	@$(MAKE) clean

tar:
	@echo $(VERSION)
	rm -rf pkg/$(REPOID).tar.gz
	@$(MAKE) buildsources
	cd pkg && tar -zcvf $(REPOID).tar.gz $(REPOID)-$(VERSION)
	@$(MAKE) clean

allarchives:
	@echo $(VERSION)
	rm -rf pkg/$(REPOID).zip
	rm -rf pkg/$(REPOID).tar
	@$(MAKE) buildsources
	cd pkg && zip -r $(REPOID).zip $(REPOID)-$(VERSION) && tar -zcvf $(REPOID).tar.gz $(REPOID)-$(VERSION)
	@$(MAKE) buildlatestzip
	@$(MAKE) clean
