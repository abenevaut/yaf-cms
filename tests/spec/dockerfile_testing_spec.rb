# frozen_string_literal: true

require 'docker'
require 'serverspec'

describe 'Dockerfile.ci' do
  before(:all) do # rubocop:disable RSpec/BeforeAfterAll
    ::Docker.options[:read_timeout] = 3000

    image = ::Docker::Image.build_from_dir(
      '.',
      'dockerfile' => 'Dockerfile.testing',
      't' => 'abenevaut/yaf-cms:rspec',
      'cache-from' => 'abenevaut/yaf-cms:latest-php83-testing'
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
