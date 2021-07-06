const path = require('path')
const { series, src, dest } = require('gulp')
const clean = require('gulp-clean')
const zip = require('gulp-zip')
const gexec = require('gulp-exec')
const gap = require('gulp-append-prepend')
const replace = require('gulp-replace')
const tap = require('gulp-tap')
const removeEmptyLines = require('gulp-remove-empty-lines')
const EOL = require('os').EOL
const exec = require('util').promisify(require('child_process').exec)
const cfg = require('./gulpfile.json')

/**
 * Perform PHP Linting
 */
async function doLint()
{
  // these may fail, it's fine
    try {
        await exec(`${cfg.phpcsfixcmd} ${cfg.phpcsparams}`)
    } catch (e) {
    }

  // these shouldn't fail
    try {
        await exec(`${cfg.phpcschkcmd} ${cfg.phpcsparams}`)
        await exec(`${cfg.phpcomptcmd} ${cfg.phpcsparams}`)
      // await exec(`${cfg.phpstancmd}`);
    } catch (e) {
        await Promise.reject(e.message)
    }
    await Promise.resolve()
}

/**
 * cleanup old build folder / archive
 * @return stream
 */
function doDistClean()
{
    return src([
        cfg.archiveBuildPath,
        cfg.archiveFileName,
        cfg.archiveFileNameEncrypted
      ],
      { read: false, base: '.', allowEmpty: true }
    ).pipe(clean({ force: true }))
}

/**
 * Copy all files/folders to build folder
 * @return stream
 */
function doCopyFiles()
{
    return src(cfg.filesForArchive, { base: '.' })
      .pipe(dest(cfg.archiveBuildPath))
}

/**
 * Clean up files
 * @return stream
 */
function doFullClean()
{
    return src(cfg.filesForCleanup, { read: false, base: '.', allowEmpty: true })
      .pipe(clean({ force: true }))
}

/**
 * Encrypt files using IONCube
 * @return Promise
 */
 function doEncrypt() {
  //let index = 0;
  const anchor = '<?php';

  // new Promise(function (resolve, reject) {
  return src(cfg.filesForEncrypt, { base: '.' })
      .pipe(replace(anchor, ''))//remove first line (php tag)
      .pipe(removeEmptyLines())//remove empty lines
      /*.pipe(tap(function (file, t) {//add ioncube dynamic key fn and key comment
          index++;
          const filename = path.basename(file.path)
          const value = (`migrationTool${filename}`).split("").reverse().join("")
          const msg = [
              anchor,
              `function MIG_KEYGEN${index}($v, $w) {`,
              '    return strrev($v.$w);',
              '}',
              `// @ioncube.dk MIG_KEYGEN${index}("migrationTool", "${filename}") -> "${value}"`
          ].join(EOL)
          return t.through(gap.prependText, [msg])
      }))*/
      .pipe(dest('tmp'))//save this to a temporary folder
      //encrypt the temporary build files using ionCube Encoder
      .pipe(gexec(file => `${cfg.ioncubecmd} ${file.path} -o ${cfg.archiveBuildPath}/${file.path.replace(/^.+\/tmp\//, '')}`, {
          continueOnError: false, // default = false, true means don't emit error event
          pipeStdout: false, // default = false, true means stdout is written to file.contents
      }))
}

/**
 * build zip archive with encrypted files in it
 * @return stream
 */
 function doZipEncrypt() {
  return doZip(cfg.archiveFileNameEncrypted)
}

/**
* build zip archive with encrypted files in it
* @return stream
*/
function doZipUnencrypt() {
  return doZip(cfg.archiveFileName)
}

/**
 * build zip archive
 * @return stream
 */
function doZip(archiveFileName) {
  return src(`./${cfg.archiveBuildPath}/**`)
    .pipe(zip(archiveFileName))
    .pipe(dest('.'))
}

exports.archives = series(
  doZipUnencrypt
)

exports.archivesEnc = series(
  doZipEncrypt
)

exports.fullclean = series(
  doFullClean
)

exports.distclean = series(
  doDistClean
)

exports.lint = series(
  doLint
)

exports.encrypt = series(
  doEncrypt
)

exports.copy = series(
  exports.distclean,
  doCopyFiles
)

exports.prepare = series(
  exports.lint,
  exports.copy
)

exports.buildEncrypted = series(
  exports.prepare,
  exports.encrypt,
  exports.archivesEnc,
  exports.fullclean
)

exports.buildUnencrypted = series(
  exports.prepare,
  exports.archives,
  exports.fullclean
)

exports.default = series(
  exports.prepare,
  exports.archives,
  exports.fullclean
)
exports.release = series(
  exports.buildEncrypted,
  exports.fullclean
)
