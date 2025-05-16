# frozen_string_literal: true

require 'docker'
require 'serverspec'
require 'json'

describe 'Dockerfile.testing' do
  before(:all) do # rubocop:disable RSpec/BeforeAfterAll
    ::Docker.options[:read_timeout] = 3000

    build_args = JSON.generate(
      COMPOSER_HASH: 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6'
    )

    image = ::Docker::Image.build_from_dir(
      '.',
      'dockerfile' => 'Dockerfile.testing',
      't' => 'abenevaut/yaf-cms:rspec',
      'cache-from' => 'abenevaut/yaf-cms:latest-php83-testing',
      'buildargs': build_args
    )

    set :os, family: :alpine
    set :backend, :docker
    set :docker_image, image.id
  end

  def composer_version
    command('composer -V').stdout
  end

  describe command('php -m') do
    it 'confirm php modules' do
      expect(subject.stdout).to match(/yaf/)
      expect(subject.stdout).to match(/Xdebug/)
    end
  end

  describe command('php -r "phpinfo();"') do
    it 'confirm phpinfo' do
      expect(subject.stdout).to match(/yaf support => enabled/)
      expect(subject.stdout).to match(/yaf.use_namespace => 1 => 1/)
      expect(subject.stdout).to match(/yaf.use_spl_autoload => 1 => 1/)
      expect(subject.stdout).to match(/yaf.environ => testing => testing/)
    end
  end

  it 'installs composer' do
    expect(composer_version).to include('2.8')
  end
end
